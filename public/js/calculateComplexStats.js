function calculateDmgAndHp(prof,int,str,vit,purpose,user_id)
{
    //purpose true => obliczenia do profilu
    //purpose false => obliczenia do walki

    var dmgMin = 0;
    var dmgMax = 0;
    var hp = 0;
    $.ajax({
        type: 'GET',
        url: '/getWeapon',
        data: {
            user_id:user_id
        },
        success: function (data) {

            switch (prof) {
                case "mage":
                    dmgMin = 2 * int * parseInt(data[0].dmg);
                    dmgMax = 4 * int * parseInt(data[0].dmg);
                    hp = 50 * vit;
                    break;

                case "knight":

                    dmgMin = str * parseInt(data[0].dmg);
                    dmgMax = 2 * str * parseInt(data[0].dmg);
                    hp = 300 * vit;
                    break;
            }
            if (purpose == true) {
                /// Dodanie do span
                if (prof == "mage") {
                    $('#mageDmgMin').html(dmgMin);
                    $('#mageDmgMax').html(dmgMax);
                    $('#healthPts').html(hp);
                    //wyswietlenie
                    $('#mageDmg').show();
                    $('#mageSep').show();
                    $('#mageDmgMin').show();
                    $('#mageDmgMax').show();

                } else {
                    $('#knightDmgMin').html(dmgMin);
                    $('#knightDmgMax').html(dmgMax);
                    $('#healthPts').html(hp);

                    //wyswietlanie
                    $('#knightDmg').show();
                    $('#knightSep').show();
                    $('#knightDmgMin').show();
                    $('#knightDmgMax').show();
                }
                console.log(dmgMin, dmgMax);


            } else {
                const stats = [dmgMin, dmgMax, hp];
                return stats;
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
   }



