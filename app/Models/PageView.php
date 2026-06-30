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

    public static function last7Days(): array
    {
        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i)->format('Y-m-d'));

        $counts = static::selectRaw('DATE(created_at) as date, COUNT(*) as views, COUNT(DISTINCT ip_address) as visitors')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->pluck('views', 'date');

        return $days->map(fn ($date) => [
            'date'  => $date,
            'label' => date('D', strtotime($date)),
            'views' => $counts[$date] ?? 0,
        ])->values()->all();
    }

    public static function topPages(int $limit = 5): array
    {
        return static::selectRaw('path, COUNT(*) as views')
            ->groupBy('path')
            ->orderByDesc('views')
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
