<!DOCTYPE html>
<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <header>
        </header>
        <div>
            <main>
           <table id="agents">
                <tr>
                    <th>Name</th>
                    <th>Current<br><span class="mobile">sales</span></th>
                    <th>Target<br><span class="mobile">sales</span></th>
                    <th><span class="mobile">Target </span>%</th>
                    <th>Status</th>
                </tr>
                @foreach($agents as $agent)
                    <tr>
                        <td>{{$agent->name}}</td>
                        <td>£{{number_format($agent->current_sales,2)}}</td>
                        <td>£{{number_format($agent->target,2)}}</td>
                        @php
                            $achievement = $agent->target > 0 ? ($agent->current_sales / $agent->target * 100) : -1;
                        @endphp
                        <td>{{$achievement >= 0 ? number_format($achievement,0)."%" : "Not set"}}</td>
                        <td class="{{$achievement >= 0 ? ($achievement == 100 ? 'orange' : ($achievement < 100 ? 'red' : 'green')) : 'noText'}}">
                            <span class="mobile">{{$achievement == "No Target" ? "" : ($achievement == 100 ? "Met" : ($achievement < 100 ? "Not Met" : "Exceeded"))}}</span>
                        </td>
                        <td>
                            <form action="{{ route('agents.update', $agent->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="btn btn-dark btn-sm me-1">Update</button>
                                <input id="updateTarget" type="number" name="updateTarget" step="0.01" value="0.00">
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    @php
                        $combinedPercentage = number_format($combinedSales / $combinedTarget * 100, 0);
                    @endphp
                    <td>Combined Sales</td>
                    <td>£{{number_format($combinedSales,2)}}</td>
                    <td>£{{number_format($combinedTarget,2)}}</td>
                    <td>£{{number_format($combinedSales / $combinedTarget * 100, 0)}}%</td>
                    <td class="{{$combinedPercentage == 100 ? 'orange' : ($combinedPercentage < 100 ? 'red' : 'green')}}">
                        <span class="mobile">{{$combinedPercentage == 100 ? "Met" : ($combinedPercentage < 100 ? "Not Met" : "Exceeded")}}</span>
                    </td>
                </tr>
           </table>
            </main>
        </div>
    </body>
</html>
