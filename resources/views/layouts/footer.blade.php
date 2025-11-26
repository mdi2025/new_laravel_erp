{{-- resources/views/layouts/footer.blade.php --}}
<footer class="bg-blue-50 border-t border-blue-200 text-xs text-blue-900">
    <div class="container mx-auto px-4 py-3">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">

            <!-- Left side - Company & User Info -->
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-x-4 gap-y-1 text-center md:text-left">
                
                <span class="font-medium text-blue-950">
                    {{ config('app.company_name', 'Advanced Microdevices Pvt. Ltd.') }}
                </span>

                <span class="hidden sm:inline text-blue-300">|</span>
                <span>Accounting Period: <strong class="text-blue-900">{{ $accountingPeriod ?? 'N/A' }}</strong></span>

                <span class="hidden sm:inline text-blue-300">|</span>
                <span class="font-medium text-blue-950">{{ config('app.name') }} ({{ config('app.version', '2.0') }})</span>

                @auth
                    <span class="hidden sm:inline text-blue-300">|</span>
                    <span>USER NAME : <strong class="text-blue-700">{{ auth()->user()->name }}</strong></span>
                @else
                    <span class="hidden sm:inline text-blue-300">|</span>
                    <span>USER NAME : <strong class="text-blue-700">Guest</strong></span>
                @endauth

            </div>

            <!-- Right side - Debug & Performance Info -->
            <div class="flex items-center gap-2 font-mono text-blue-700 text-[10px] lg:text-xs">
                
                <span class="text-blue-800">©{{ date('Y') }} mdi</span>

                @if(config('app.debug') || app()->environment('local'))
                    <span class="hidden lg:inline text-blue-300">•</span>

                    <!-- Execution Time -->
                    <span class="hidden lg:inline" title="Page execution time">
                        ({{ round(microtime(true) - LARAVEL_START, 2) }}s)
                    </span>

                    @if(function_exists('getDatabaseQueryCount'))
                        <span class="hidden xl:inline text-blue-300">•</span>
                        <span class="hidden xl:inline">
                            {{ getDatabaseQueryCount() }} SQLs 
                            ({{ round(DB::getQueryLogTime(), 2) }}ms)
                        </span>
                    @endif

                    <span class="hidden xl:inline text-blue-300">•</span>
                    <span class="hidden xl:inline">{{ request()->ip() }}</span>
                @endif

            </div>
        </div>
    </div>
</footer>
