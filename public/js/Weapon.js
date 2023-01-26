function sellPlayersWeapon(usr_id)
{
    $.ajax({
        type: 'GET',
        url: '/sellWeapon',
        data: {
            user_id: usr_id
        },
        success: function (data) {
            Swal.fire("Sprzedano obecną broń!");
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function buyWeapon(usr_id,gold,img,dmg,value,name)
{

        $.ajax({
            type: 'GET',
            url: '/buyWeapon',
            data: {
                user_id: usr_id,
                name: name,
                gld: gold,
                img: img,
                value: value,
                dmg: dmg
            },
            success: function (data) {
                Swal.fire("Kupiono!");
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
}

function shopWeapons(playerLevel,gold,usr_id,currentWeaponValue)
{
const prof = $('#prof').text();
for(let i = 1; i<4; i++)
{
    let dmg = (Math.floor(Math.random() * ((parseInt(playerLevel) + 1) -((parseInt(playerLevel) / 2) + 1) +1) + ((parseInt(playerLevel) / 2) +1)))+1;
    let value = dmg*50;
    let img = Math.floor(Math.random() * 3) + 1;
    let tmp = "";
    if(prof=="mage")
    {
        $('#item' + (i)).html(
            '<img id="item'+i+'img" src="storage/weapons/mage/'+img+'.png" >'
           );
        tmp="/weapons/mage/"+img+".png";
    }else
    {
        $('#item' + (i)).html(
            '<img id="item'+i+'img" src="storage/weapons/knight/'+img+'.png" >');
        tmp="/weapons/knight/"+img+".png";
    }
    $('#name' + (i)).html("Broń");
    $('#dmg' + (i)).html(dmg);
    $('#value' + (i)).html(value);


    $("#item" + i).hover(function () {
        Swal.fire({
            title: $('#name' + (i)).text(),
            html: "<b>Obrażenia:</b> " +$("#dmg" + i).text()+"<br><b>Wartość:</b> "+  $('#value' + (i)).text(),
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Kup',
            showCancelButton: true,
            CancelButtonText: 'Anuluj'
        }).then((result) => {
            if (result.isConfirmed) {
                if(gold>=value)
                {
                    if(currentWeaponValue ==0) {
                        gold -= value;
                        buyWeapon(usr_id, gold,
                            tmp,
                            parseInt($("#dmg" + i).text()),
                            parseInt(($('#value' + (i)).text()) )/2,
                            $('#name' + (i)).text()
                        );
                    }else
                    {
                        Swal.fire("Najpierw sprzedaj obecną broń!");
                    }
                } //window.location.reload();
            else{
                    Swal.fire("Za mało złota!");
                }
            }
        });
    });



}



}




function showWeapon(user_id)
{

    $.ajax({
        type: 'GET',
        url: '/getWeapon',
        data: {
            user_id:user_id
        },
        success: function (data) {

           if(parseInt(data[0].value) != 0) {
                console.log(data);
                $("#weapon").hover(function () {
                    Swal.fire({
                        title: data[0].Name,
                        html: "<b>Obrażenia:</b> " +data[0].dmg+"<br><b>Wartość:</b> "+data[0].value,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Sprzedaj',
                        showCancelButton: true,
                        CancelButtonText: 'Anuluj'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            sellPlayersWeapon(data[0].user_id);

                            $("#weaponSlot").html(
                                '<img id="weapon" class="img-thumbnail" src="storage/weapons/empty.png" >'
                            );
                            window.location.replace('/home');
                        }
                    });
                });
          }


        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
