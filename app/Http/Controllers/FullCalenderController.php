<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Event;


class FullCalenderController extends Controller
{
    public function calendar(Request $request) {
        $currentMonth = $request->month ?? Carbon::now()->month;
        $currentYear = $request->year ?? Carbon::now()->year;

        $originDate = Carbon::createFromDate($currentYear, $currentMonth, Carbon::now()->day);

        $firstDayOfMonth = Carbon::createFromDate($originDate->year, $originDate->month, 1)->setTime(0, 0, 0);
        $lastDayOfMonth = Carbon::createFromDate($originDate->year, $originDate->month, $originDate->daysInMonth)->setTime(23, 59, 59);

        // get events for current month, but only if date has events
        $events = Event::select('id', 'date')->distinct('date')->whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])->get()->groupBy('date')->toArray();

        $daysInMonth = [];

        $firstDayOfMonthInWeek = $firstDayOfMonth->dayOfWeek == 0 ? 7 : $firstDayOfMonth->dayOfWeek;
        for ($i = $firstDayOfMonthInWeek -1; $i > 0; $i--) {
            $firstDayOfMonth = $firstDayOfMonth->subDay();
            $daysInMonth[] = [
                'day' => $firstDayOfMonth->day,
                'depressed' => true,
                'date' => $firstDayOfMonth->format('d.m.Y'),
                'currentDay' => $firstDayOfMonth->isToday(),
                'hasEvents' => false
            ];
        }
        $daysInMonth = array_reverse($daysInMonth);

        for ($i = 1; $i <= $lastDayOfMonth->day; $i++) {
            $day = Carbon::createFromDate($originDate->year, $originDate->month, $i);
            $hasEvents = false;
            if ($events[$day->format('Y-m-d')] ?? false) {
                $hasEvents = true;
            }
            $daysInMonth[] = [
                'day' => $day->day,
                'depressed' => false,
                'date' => $day->format('d.m.Y'),
                'currentDay' => $day->isToday(),
                'hasEvents' => $hasEvents
            ];
        }

        $lastDayOfMonthInWeek = $lastDayOfMonth->dayOfWeek == 0 ? 7 : $lastDayOfMonth->dayOfWeek;
        for ($i = $lastDayOfMonthInWeek + 1; $i <= 7; $i++) {
            $lastDayOfMonth = $lastDayOfMonth->addDay();
            $daysInMonth[] = [
                'day' => $lastDayOfMonth->day,
                'depressed' => true,
                'date' => $lastDayOfMonth->format('d.m.Y'),
                'currentDay' => $lastDayOfMonth->isToday(),
                'hasEvents' => false
            ];
        }

        return view('calendar')->with([
            'daysInMonth' => $daysInMonth,
            'originDate' => $originDate,
            'previousMonth' => $originDate->copy()->subMonth()->format('m'),
            'previousYear' => $originDate->copy()->subMonth()->format('Y'),
            'nextMonth' => $originDate->copy()->addMonth()->format('m'),
            'nextYear' => $originDate->copy()->addMonth()->format('Y'),
        ]);
    }

    public function createEvent(Request $request) {
        $date = $request->get('date');
        $dateCarbon = Carbon::parse($date);
        return view('event.create')->with([
            'date' => $dateCarbon,
        ]);
    }

    public function storeEvent(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'note' => 'nullable|string',
            'date' => 'required|date_format:d.m.Y',
        ]);

        Event::create([
            'title' => $request->get('title'),
            'note' => $request->get('note'),
            'date' => Carbon::parse($request->get('date')),
        ]);

        return redirect()->route('calendar');
    }

    public function apiEvents(Request $request) {
        $date = Carbon::parse($request->get('date'));
        $events = Event::select('id', 'title', 'note', 'date')->whereDate('date', $date)->get();
        return response()->json($events);
    }
}
