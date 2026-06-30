<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public $timestamps = false;

    protected $fillable = ['ip_address', 'path', 'user_agent', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public static function uniqueVisitors(): int
    {
        return static::distinct('ip_address')->count('ip_address');
    }

    public static function thisMonth(): array
    {
        $start = now()->startOfMonth();
        $today = now()->startOfDay();

        $days = collect();
        for ($d = $start->copy(); $d->lte($today); $d->addDay()) {
            $days->push($d->format('Y-m-d'));
        }

        $counts = static::selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->where('created_at', '>=', $start)
            ->groupBy('date')
            ->pluck('views', 'date');

        return $days->map(fn ($date) => [
            'date'  => $date,
            'label' => date('j', strtotime($date)),
            'views' => $counts[$date] ?? 0,
        ])->values()->all();
    }
}
