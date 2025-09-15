<tr>
    <td>
        <table class="footer" ...>
            <tr>
                <td class="content-cell" align="center">
                    {{ Illuminate\Mail\Markdown::parse('© ' . date('Y') . ' ' . config('app.name') . '. All rights reserved.') }}

                    {{-- TAMBAHKAN TEKS BARU DI SINI --}}
                    <p style="font-size: 12px; color: #A8AAAF; line-height: 1.5em; margin-top: 10px;">
                        KaryaLokal HQ<br>
                        Padang, West Sumatra
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
