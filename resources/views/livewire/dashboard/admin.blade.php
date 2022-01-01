<div>
    <div class="max-w-7xl mx-auto my-6 px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 sm:col-span-2 md:col-span-1 p-4 bg-white dark:bg-gray-800 rounded-lg border dark:border-gray-600 shadow-sm">
                <div class="text-gray-500 dark:text-gray-300 text-xs">{{__("Total Views")}}</div>
                <div class="mt-2 text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $totalArticleReads }}</div>
            </div>

            <div class="col-span-4 sm:col-span-2 md:col-span-1 p-4 bg-white dark:bg-gray-800 rounded-lg border dark:border-gray-600 shadow-sm">
                <div class="text-gray-500 dark:text-gray-300 text-xs">{{__("Avg Article Views")}}</div>
                <div class="mt-2 text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $avgArticleReads }}</div>
            </div>

            <div class="col-span-4 sm:col-span-2 md:col-span-1 p-4 bg-white dark:bg-gray-800 rounded-lg border dark:border-gray-600 shadow-sm">
                <div class="text-gray-500 dark:text-gray-300 text-xs">{{__("Articles Created")}}</div>
                <div class="mt-2 text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $articlesMade }}</div>
            </div>

            <div class="col-span-4 sm:col-span-2 md:col-span-1 p-4 bg-white dark:bg-gray-800 rounded-lg border dark:border-gray-600 shadow-sm">
                <div class="text-gray-500 dark:text-gray-300 text-xs">{{__("Monthly Increase")}}</div>
                <div class="mt-2 flex items-center">
                    <div class="text-lg font-semibold text-gray-700 dark:text-gray-200">{{ $monthlyIncrease }}</div>
                    @if ($monthlyIncreasePercentage > 0)
                        <div class="ml-4 text-xs px-1 py-0.5 bg-green-100 text-green-800 rounded-md">&uparrow; {{ $monthlyIncreasePercentage }}%</div>
                    @elseif ($monthlyIncreasePercentage == 0)
                        <div class="ml-4 text-xs px-1 py-0.5 bg-gray-100 text-gray-800 rounded-md">{{ $monthlyIncreasePercentage }}%</div>
                    @else
                        <div class="ml-4 text-xs px-1 py-0.5 bg-red-100 text-red-600 rounded-md">&downarrow; {{ $monthlyIncreasePercentage }}%</div>
                    @endif
                </div>
            </div>
        </div>

        @if (count($monthlyCount) > 0)
            <div class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                <div class="text-gray-500 dark:text-gray-300 text-xs">{{__("Overall Monthly Reads")}}</div>
                <div id="chart" class="dark:text-white"></div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                var options = {
                        chart: {
                            type: 'area',
                            height: 350
                        },
                        series: [{
                            name: '{{Carbon\Carbon::now()->format('Y')}}',
                            data: [
                                @forelse ($monthlyCount as $click)
                                    @if ($click->year == Carbon\Carbon::now()->format('Y'))
                                        {
                                            x: '{{$click->month_label . ' ' . $click->year}}',
                                            y: '{{$click->total}}'
                                        },
                                    @endif
                                @empty

                                @endforelse
                            ],
                        },

                        {
                            name: '{{Carbon\Carbon::now()->subYear()->format('Y')}}',
                            data: [
                                @forelse ($monthlyCount as $click)
                                    @if ($click->year == Carbon\Carbon::now()->subYear()->format('Y'))
                                    {
                                        x: '{{$click->month_label . ' ' . $click->year}}',
                                        y: '{{$click->total}}'
                                    },
                                    @endif
                                @empty

                                @endforelse
                            ],
                        },
                    ],
                    xaxis: {
                        type: 'category'
                    },
                    theme: {
                        palette: 'palette1' // upto palette10
                    }
                }
                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            </script>
        @endif

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="col-span-2 sm:col-span-1 p-4 bg-white rounded-lg border shadow-sm">
                <div class="text-gray-500 text-xs">{{__("Most Popular Articles")}}</div>
                <ul>
                    @forelse ($mostPopularArticles as $article)
                        <li class="flex items-center justify-between py-2 border-b">
                            <div class="text-sm font-semibold text-gray-700">{{$article->title}}</div>
                            <div class="text-gray-800 text-xs">{{$article->total . ' ' . __("times read")}}</div>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </div>

            <div class="col-span-2 sm:col-span-1 p-4 bg-white rounded-lg border shadow-sm">
                <div class="text-gray-500 text-xs">{{__("Most Reads By Region")}}</div>
                <ul>
                    @forelse ($mostReadsByRegion as $region)
                        <li class="flex items-center justify-between py-2 border-b">
                            <div class="text-sm font-semibold text-gray-700">{{$region->region ?? __('Unspecified')}}</div>
                            <div class="text-gray-800 text-xs">{{$region->total . ' ' . __("visits")}}</div>
                        </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
