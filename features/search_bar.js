function fill( symbol )
{
    let search_bar = document.getElementById( 'symbol' );
    search_bar.value = symbol;
}


let input = document.getElementById( 'symbol' );
input.addEventListener( 'input', async function ()
{
    let response = await fetch( './company_data.php?q=' + input.value );
    let result = await response.json();
    let html = '';

    let dataArray = result[ 'result' ];

    for ( let i in dataArray )
    {
        if ( dataArray[ i ][ "displaySymbol" ].includes( "." ) ) continue;
        let name = dataArray[ i ][ "description" ];
        let symbol = dataArray[ i ][ "displaySymbol" ];
        html += '<li>' + '<button onclick="fill(' + '`' + symbol + '`' + ')">' + '<p>' + name + '</p>' + '<p>' + symbol + '</p>' + '</button>' + '</li>';
    }
    document.getElementById( 'suggestions' ).innerHTML = html;
} );