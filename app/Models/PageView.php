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

    public static function thisWeek(): array
    {
        $monday = now()->startOfWeek(); // Monday
        $today  = now()->startOfDay();

        $days = collect();
        for ($d = $monday->copy(); $d->lte($today); $d->addDay()) {
            $days->push($d->format('Y-m-d'));
        }

        $counts = static::selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->where('created_at', '>=', $monday)
            ->groupBy('date')
            ->pluck('views', 'date');

        return $days->map(fn ($date) => [
            'date'  => $date,
            'label' => date('D', strtotime($date)),
            'views' => $counts[$date] ?? 0,
        ])->values()->all();
    }
}
