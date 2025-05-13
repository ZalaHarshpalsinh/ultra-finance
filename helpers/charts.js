function getCookie( cname )
{
    let name = cname + "=";
    let decodedCookie = decodeURIComponent( document.cookie );
    let ca = decodedCookie.split( ';' );
    for ( let i = 0; i < ca.length; i++ )
    {
        let c = ca[ i ];
        while ( c.charAt( 0 ) == ' ' )
        {
            c = c.substring( 1 );
        }
        if ( c.indexOf( name ) == 0 )
        {
            return c.substring( name.length, c.length );
        }
    }
    return "";
}

function load_candlestick_chart( symbol )
{
    //div to draw chart into
    const chart_div = document.getElementById( 'chart' );

    // Load the Google Charts library 
    google.charts.load( 'current', { packages: [ 'corechart' ] } );
    google.charts.setOnLoadCallback( drawChart );

    // Fetch candlestick data from Finnhub API
    function fetchData( callback )
    {
        const url = `../helpers/candleData.php?q=${symbol}`;

        fetch( url )
            .then( response => response.json() )
            .then( data =>
            {
                if ( data[ "Error Message" ] || data[ "Information" ] )
                {
                    callback( new Error( 'Failed to fetch data' ) );
                } else
                {
                    callback( null, data );
                }
            } )
            .catch( error =>
            {
                callback( error );
            } );
    }

    // Draw the candlestick chart using Google Charts
    function drawChart()
    {
        fetchData( ( error, data ) =>
        {
            if ( error )
            {
                console.log( error );
                chart_div.innerHTML = '<h2 style="color:red;">Failed to load the chart. Please try again later</h2>';
                return;
            }

            const chartData = [];

            // Format the data for Google Charts
            for ( let date in data[ "Time Series (Daily)" ] )
            {
                const row = [
                    date,
                    parseFloat( data[ "Time Series (Daily)" ][ date ][ "3. low" ] ),
                    parseFloat( data[ "Time Series (Daily)" ][ date ][ "1. open" ] ),
                    parseFloat( data[ "Time Series (Daily)" ][ date ][ "4. close" ] ),
                    parseFloat( data[ "Time Series (Daily)" ][ date ][ "2. high" ] )
                ];
                chartData.push( row );
            }

            const dataTable = google.visualization.arrayToDataTable( chartData, true );

            company_name = getCookie( 'name' );
            symbol = getCookie( 'symbol' );

            const chartOptions =
            {
                legend: 'none',
                title: company_name + '\n' + symbol,
                titleTextStyle:
                {
                    fontSize: 20,
                },
                aggregationTarget: 'series',
                bar: { groupWidth: '90%', groupHeight: '100%' },
                animation:
                {
                    duration: 1000,
                    startup: true,
                    easing: 'out',
                },
                backgroundColor:
                {
                    fill: '#8adbc7',
                    stroke: 'black',
                    strokeWidth: 10,
                },
                candlestick:
                {
                    fallingColor: { strokeWidth: 0, fill: '#a52714' }, // red
                    risingColor: { strokeWidth: 0, fill: '#0f9d58' } // green
                },
                chartArea:
                {
                    backgroundColor: 'white',
                },
                hAxis:
                {
                    title: 'Dates',
                    titleTextStyle:
                    {
                        fontSize: 10,
                        bold: true,
                    },
                    slantedText: true,
                    slantedTextAngle: 45,
                },
                vAxis:
                {
                    title: 'Price in USD($)',
                    titleTextStyle:
                    {
                        fontSize: 30,
                        bold: true,
                    },
                    gridlines:
                    {
                        color: 'black',
                    },
                },
            };

            const chart = new google.visualization.CandlestickChart( chart_div );
            chart.draw( dataTable, chartOptions );
        } );
    }
}

function load_suggestions_chart( symbol )
{
    //div to chart into
    const chart_div = document.getElementById( 'suggestions' );

    // Load the Google Charts library
    google.charts.load( 'current', { packages: [ 'corechart' ] } );
    google.charts.setOnLoadCallback( drawChart );

    // Fetch recommendations data from Finnhub API
    function fetchData( callback )
    {

        const url = `../helpers/suggestionData.php?q=${symbol}`;
        fetch( url )
            .then( response => response.json() )
            .then( data =>
            {
                if ( data.length > 0 )
                {
                    callback( null, data );
                } else
                {
                    callback( new Error( 'Failed to fetch data' ) );
                }
            } )
            .catch( error =>
            {
                callback( error );
            } );
    }

    // Draw the recommendations chart using Google Charts
    function drawChart()
    {
        fetchData( ( error, data ) =>
        {
            if ( error )
            {
                console.error( error );
                chart_div.innerHTML = 'Failed to load the chart. Please try again later.';
                return;
            }

            const chartData =
                [
                    [ 'Suggestion', 'strength of suggestion', { role: 'style' } ],
                    [ 'Strong Buy', data[ 0 ].strongBuy, '#035418' ],
                    [ 'Buy', data[ 0 ].buy, '#2ef23e' ], [ 'Hold', data[ 0 ].hold, '#dcf230' ],
                    [ 'Sell', data[ 0 ].sell, '#eb4b07' ],
                    [ 'Strong Sell', data[ 0 ].strongSell, '#940404' ]
                ];


            const dataTable = google.visualization.arrayToDataTable( chartData );

            const chartOptions = {
                legend: 'none',
                animation:
                {
                    startup: true,
                    easing: 'out',
                    duration: 1000,
                },
                backgroundColor:
                {
                    fill: '#a894e0',
                    stroke: 'black',
                    strokeWidth: 10,
                },
                chartArea:
                {
                    backgroundColor: 'white',
                },
                vAxis:
                {
                    gridlines:
                    {
                        color: 'black',
                    },
                },
                tooltip:
                {
                    isHtml: true,
                },
            };

            const chart = new google.visualization.ColumnChart( chart_div );

            chart.draw( dataTable, chartOptions );
        } );
    }

}

let symbol = getCookie( 'symbol' );
load_candlestick_chart( symbol );
load_suggestions_chart( symbol );