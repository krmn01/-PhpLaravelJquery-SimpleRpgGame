function deleteFight()
{
    $.ajax({
        type: 'GET', ///musiałem ustawić get ponieważ gdy w routach był delete i tu był delete dostawałem błąd 419
        url: '/deleteFight',
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function updateFight(p1hp,p2hp,patck)
{
    if(p1hp!=null&&p2hp!=null&&patck!=null) {
        $.ajax({
            type: 'GET', ///musiałem ustawić get ponieważ gdy w routach był delete i tu był delete dostawałem błąd 419
            url: '/updateFight',
            data:
                {
                    p1hp: p1hp,
                    p2hp: p2hp,
                    patck: patck
                },
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
}

function addFight(p1hp,p1maxhp,p2hp,p2maxhp,p1mindmg,p1maxdmg,p2mindmg,p2maxdmg,p2lvl)
{
    $.ajax({
        type: 'GET',
        url: '/addFight',
        data: {
            p1hp: p1hp,
            p2hp: p2hp,
            p1dmg: p1mindmg,
            p2dmg: p2mindmg,
            p1maxdmg: p1maxdmg,
            p2maxdmg: p2maxdmg,
            p1maxhp: p1maxhp,
            p2maxhp: p2maxhp,
            p2lvl : p2lvl,
            patck : 1
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
function getFight()
{
    $.ajax({
        type: 'GET',
        url: '/getFight',
        data: {},
        success: function (data) {
            return data;
        },
        error: function (data) {
            console.log('Error:', data);
            return [];
        }
    });
}


    function startFight(p1hp, p1maxhp, p2hp, p2maxhp, p1mindmg, p1maxdmg, p2mindmg, p2maxdmg, p2lvl, patck,p2_id,p1_id,prof1,int1,str1,vit1,prof2,int2,str2,vit2, continuing) {

////const stats = [dmgMin, dmgMax, hp];
        if (!continuing) {
            var p1stats = [0,0,0];
            var p2stats = [0,0,0];

            //p1

            $.ajax({
                type: 'GET',
                url: '/getWeapon',
                data: {
                    user_id: p1_id
                },
                success: function (data) {
                    switch (prof1) {
                        case "mage":
                            console.log(parseInt(data[0].dmg));
                            p1stats[0] = 2 * int1 * parseInt(data[0].dmg);
                            p1stats[1] = 4 * int1 * parseInt(data[0].dmg);
                            p1stats[2] = 50 * vit1;
                            break;

                        case "knight":

                            p1stats[0] = str1 * parseInt(data[0].dmg);
                            p1stats[1] = 2 * str1 * parseInt(data[0].dmg);
                            p1stats[2] = 300 * vit1;
                            break;
                    }
                    ///p2
                    $.ajax({
                        type: 'GET',
                        url: '/getWeapon',
                        data: {
                            user_id: p2_id
                        },
                        success: function (data) {
                            switch (prof2) {
                                case "mage":
                                    console.log(parseInt(data[0].dmg));
                                    p2stats[0] = 2 * int2 * parseInt(data[0].dmg);
                                    p2stats[1] = 4 * int2 * parseInt(data[0].dmg);
                                    p2stats[2] = 50 * vit2;
                                    break;

                                case "knight":

                                    p2stats[0] = str2 * parseInt(data[0].dmg);
                                    p2stats[1] = 2 * str2 * parseInt(data[0].dmg);
                                    p2stats[2] = 300 * vit2;
                                    break;
                            }
                            p1hp = p1stats[2];
                            p2hp = p2stats[2];
                            p1maxhp = p1hp;
                            p2maxhp = p2hp
                            p1mindmg = p1stats[0];
                            p2mindmg = p2stats[0];
                            p1maxdmg = p1stats[1];
                            p2maxdmg = p2stats[1];
                            patck = 1;

                            addFight(p1hp, p1maxhp, p2hp, p2maxhp, p1mindmg, p1maxdmg, p2mindmg, p2maxdmg, parseInt(p2lvl));
                        },
                        error: function (data) {
                            console.log('Error:', data);

                        }
                    });

                },
                error: function (data) {
                    console.log('Error:', data);

                }
            });







        }//else {
            $('#progress1').html(
                "<div class='progress-bar' id='progressBar1' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='" + p1maxhp + "'></div>");
            $('#progress2').html(
                "<div class='progress-bar' id='progressBar2' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='" + p2maxhp + "'></div>");

            var p1Bar = document.getElementById("progressBar1");
            var p2Bar = document.getElementById("progressBar2");

            $('#playerRank').hide();
            $('#playerFight').show();

            var playerAttack  = patck;


                var intervalId = setInterval(function () {
                    if (playerAttack == true) {
                        let randomizedDmg = Math.floor(Math.random() * (parseInt(p1maxdmg) - parseInt(p1mindmg) + 1)) + parseInt(p1mindmg);
                        let tmp = parseInt(p2hp) - randomizedDmg;
                        p2hp = tmp;
                        $('#player1attack').html(
                            "<br><br><h4 style=\"color:forestgreen;\">Gracz zadał " + randomizedDmg + " pkt. obrażeń.</h4>" +
                             "<h4 style=\"color:darkred;\">Przeciwnikowi pozostało " + tmp + " pkt. życia.</h4>"
                        )
                        p1Bar.style.width = (p1hp/ p1maxhp * 100) + '%';
                        p2Bar.style.width = (p2hp/ p2maxhp * 100) + '%';
                        playerAttack = false;
                        var tmp1 = p1hp;
                        var tmp2 = p2hp;
                        updateFight(tmp1,tmp2,0);
                    } else {
                        let randomizedDmg = Math.floor(Math.random() * (parseInt(p2maxdmg) - parseInt(p2mindmg) + 1)) + parseInt(p2mindmg);
                        let tmp = parseInt(p1hp) - randomizedDmg;
                        p1hp = tmp;
                        $('#player1attack').html(
                            "<br><br><h4 style=\"color:darkred;\">Przeciwnik zadał " + randomizedDmg + " pkt. obrażeń.</h4>" +
                            "<h4 style=\"color:forestgreen;\"> Graczowi pozostało " + tmp + " pkt. życia.</h4>"
                        )
                        p1Bar.style.width = (p1hp/ p1maxhp * 100) + '%';
                        p2Bar.style.width = (p2hp/ p2maxhp * 100) + '%';
                        playerAttack = true;
                        var tmp1 = p1hp;
                        var tmp2 = p2hp;
                        updateFight(tmp1,tmp2,1);
                    }
                    if (parseInt(p1hp) <= 0 || parseInt(p2hp) <= 0) {
                        clearInterval(intervalId);
                        if (parseInt(p1hp) > 0) {
                            p1Bar.style.width = (p1hp/ p1maxhp * 100) + '%';
                            p2Bar.style.width = 0 + '%';
                            Swal.fire({
                                title: 'Wygrałeś!',
                                //text: "Zdobyłeś " + parseInt(p2lvl) * 5 + " szt. złota.",
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    deleteFight();


                                    window.location.reload();
                                }
                            });
                        } else {
                            p1Bar.style.width = 0 + '%';
                            p2Bar.style.width = (p2hp/ p2maxhp * 100) + '%';
                            Swal.fire({
                                title: 'Przegrałeś!',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    deleteFight();

                                    window.location.reload();

                                }
                            });

                        }

                    }

                }, 1000);
           // }

    }


    function changeRankVisibility() {
        $.ajax({
            type: 'GET',
            url: '/getFight',
            data: {},
            success: function (data) {
                if ($.isEmptyObject(data)) $('#playerRank').show();
                else {
                    //startFight(p1hp, p1maxhp, p2hp, p2maxhp, p1mindmg, p1maxdmg, p2mindmg, p2maxdmg, p2lvl, patck,p2_id,p1_id,prof1,int1,str1,vit1,prof2,int2,str2,vit2, continuing)
                    startFight(data[0].player1Hp, data[0].player1MaxHp, data[0].player2Hp, data[0].player2MaxHp, data[0].player1DmgMin, data[0].player1DmgMax, data[0].player2DmgMin, data[0].player2DmgMax, data[0].player2lvl, data[0].playerAttacks,0,0,0,0,0,0,0,0,0,0, true);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
