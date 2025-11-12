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
           <table>
                <tr>
                    <th>Name</th>
                    <th>Current sales</th>
                    <th>Sales target</th>
                    <th>Target achieved %</th>
                    <th>Status</th>
                </tr>
                @foreach($agents as $agent)
                        <tr>
                            <td>{{$agent->name}}</td>
                            <td>£{{number_format($agent->current_sales,2)}}</td>
                            <td>£{{number_format($agent->target,2)}}</td>
                            @php
                                $achievement = $agent->target > 0 ? number_format($agent->current_sales / $agent->target * 100, 0) : 0;
                            @endphp
                            <td>{{$achievement}}%</td>
                            <td class="{{$achievement == 100 ? 'orange' : ($achievement < 100 ? 'red' : 'green')}}">{{
                                $achievement == 100 ? "Met" : ($achievement < 100 ? "Not Met" : "Exceeded")
                            }}</td>
                            <td>
                                <form action="{{ route('agents.update', $agent->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-dark btn-sm me-1">Update target</button>
                                    <input id="updateTarget" type="number" name="updateTarget" step="0.01" value="0.00">
                                </form>
                            </td>
                        </tr>
                @endforeach
           </table>
            </main>
        </div>
    </body>
</html>
