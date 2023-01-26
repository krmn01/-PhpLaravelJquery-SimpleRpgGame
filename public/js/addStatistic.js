
function updateComplex(int,str,vit,dmg)
{
    var dmgMin = 0;
    var dmgMax = 0;
    var hp = 0;


            let text = $('#prof').text();
            if (text === "mage") {
                dmgMin = 2 * int*dmg;
                dmgMax = 4 * int*dmg;
                hp = 50 * vit;
            } else if (text === "knight") {
                dmgMin = str*dmg;
                dmgMax = 2 * str*dmg;
                hp = 300 * vit;
            }


            return [dmgMin,dmgMax,hp];

}
function updateStatistics(playerId) {
    $.ajax({
        type: 'GET',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: '/getUpdatedStatistics',
        data: {
            user_id: playerId
        },
        success: function (data) {
            console.log(data);
           ////W przypadku sukcesu update wyswietlanych statystyk
            $('#intelligence').html(data[0].intelligence);
            $('#vitality').html(data[0].vitality);
            $('#strength').html(data[0].strength);
            $('#gold').html(data[0].gold);
            let complexStats = updateComplex(data[0].intelligence,data[0].strength,data[0].vitality,data[0].dmg);
            console.log(complexStats);
            let text = $('#prof').text();

                if (text === "mage") {
                    $('#mageDmgMin').html(complexStats[0]);
                    $('#mageDmgMax').html(complexStats[1]);
                    $('#healthPts').html(complexStats[2]);
                    //wyswietlenie
                    $('#mageDmg').show();
                    $('#mageSep').show();
                    $('#mageDmgMin').show();
                    $('#mageDmgMax').show();
                } else {
                    $('#knightDmgMin').html(complexStats[0]);
                    $('#knightDmgMax').html(complexStats[1]);
                    $('#healthPts').html(complexStats[2]);

                    //wyswietlanie
                    $('#knightDmg').show();
                    $('#knightSep').show();
                    $('#knightDmgMin').show();
                    $('#knightDmgMax').show();
                }

        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
function addStat(playerStat,playerGold,statId,playerId)
{
    /*
    Przed dodaniem statystyki sprawdzam czy uzytkownik ma wystarczajaco duzo złota
    Koszt 1 punktu umiejętności jest równy aktualnej ilości punktów danej umiejętności
    */

    console.log(statId);
    if(playerGold>=playerStat) {
        var stat = null;

        switch (statId) {
            case 1:
                stat = "intelligence";
                break;
            case 2:
                stat = "strength";
                break;
            case 3:
                stat = "vitality";
                break;
            default:
                break;
        }
        playerGold-=playerStat;
        console.log(stat);
        if(stat != null) {
            $.ajax({
                type: 'POST',
                url: '/addStat',
                headers: {'X-CSRF-TOKEN': csrf_token},
                data: {
                    user_id: playerId,
                    gold: playerGold,
                    statName: stat
                },
                success: function (data) {
                    console.log(data);
                    updateStatistics(playerId);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

    }
}
