# Plan: Perbaiki Responsive Mobile untuk Landing Page & Dashboard

## Masalah Teridentifikasi

### Landing Page
- Navigation menu hilang di mobile (line 25: `hidden md:flex`)
- Tidak ada hamburger menu

### Dashboard  
- Sidebar fixed-width `w-64` tidak responsive (line 12)
- Tidak ada toggle untuk mobile

### Dashboard Table
- Table sulit dibaca di mobile

## Solusi

1. Landing Page: Tambah mobile nav dengan hamburger + Alpine.js overlay
2. Dashboard: Sidebar responsive dengan toggle mobile
3. Dashboard Table: Card layout untuk mobile
4. Polish: text sizing & spacing optimization

## Implementation Order

1. Landing Page Mobile Nav (critical)
2. Dashboard Responsive Sidebar (critical)
3. Dashboard Table Cards (medium)
4. General Polish (low)

## Files to Modify

1. `resources/views/welcome.blade.php`
2. `resources/views/layouts/dashboard.blade.php`
3. `resources/views/livewire/dashboard.blade.php`
