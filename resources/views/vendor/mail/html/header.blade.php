@props(['url'])
<tr>
    <td class="header">
        <a href="{{ config('app.url') }}"
            style="display: inline-block; padding: 25px 0; text-align: center; width: 100%;">
            {{-- Tampilkan logomu di sini --}}
            <img src="{{ asset('assets/img/fav.png') }}" class="logo" alt="KaryaLokal Logo" style="width: 180px; border: 0;">
        </a>
    </td>
</tr>

