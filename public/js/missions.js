
function setTimeLimit(mission,playerLvl,playerId,playerExp,playerGold,continuing,currentT) {
    var timeLimit;
    switch(mission) {
        case "mission1":
            timeLimit = 10;
            break;
        case "mission2":
            timeLimit = 20;
            break;
        case "mission3":
            timeLimit = 30;
            break;
    }
    document.getElementById("startMissionBtn").disabled = false;
    document.getElementById("startMissionBtn").onclick = function() { startMission(timeLimit,playerLvl,playerId,playerExp,playerGold); };
}

function addExperience(playerLevel,playerId,playerExp,Exp,playerGold,Gold)
{
    playerExp+=Exp;
    playerGold+=Gold;


    $.ajax({
        type: 'POST',
        url: '/updateExperience',
        headers: {'X-CSRF-TOKEN': csrf_token},
        data: {
            user_id: playerId,
            experience: playerExp,
            gold: playerGold
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}

function checkLevelUp(currentExp, playerLvl, playerId){
    if(currentExp >= (playerLvl*playerLvl*15)){
        currentExp-=(playerLvl*playerLvl*15);
        playerLvl+=1;
        $.ajax({
            type: 'POST',
            url: '/updateLevel',
            headers: {'X-CSRF-TOKEN': csrf_token},
            data: {
                user_id: playerId,
                experience: currentExp,
                level: playerLvl
            },
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      Swal.fire("Awansowano na "+playerLvl+" poziom doświadczenia");
    }

}

function deleteMission(playerId)
{
    $.ajax({
        type: 'DELETE',
        url: '/deleteMission/'+playerId,
        headers: {'X-CSRF-TOKEN': csrf_token},
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}
function addMission(timeLimit, playerLevel,playerId)
{
    const exp = timeLimit * playerLevel;
    const gold = timeLimit * playerLevel;
    var tmp = "";
    switch(timeLimit)
    {
        case 10:
            tmp="+10 seconds";
            break;
        case 20:
            tmp="+20 seconds";
            break;
        case 30:
            tmp="+30 seconds";
            break;
    }

    ///Dane o misji do bazy
    $.ajax({
        type: 'POST',
        url: '/addMission',
        headers: {'X-CSRF-TOKEN': csrf_token},
        data: {
            user_id: playerId,
            gold: gold,
            exp: exp,
            time: tmp
        },
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}

function changeMissionVisibility(playerLevel,playerId,playerExp,playerGold)
{
    $.ajax({
        type: 'GET',
        url: '/getMission',
        data: {
            user_id: playerId
        },
        success: function (data) {
            //if(status===parseInt(status))$('#missionView').show();
            if($.isEmptyObject(data))$('#missionView').show();
            else{
                let currentDate = new Date();
                currentDate.setHours(currentDate.getHours() - 1); // przez roznice 1 godziny
                console.log(currentDate);
                let tmp = (currentDate-Date.parse(data[0].startTime))/1000;
                let tmp2 = (Date.parse(data[0].endTime)-Date.parse(data[0].startTime))/1000;
                startMission(tmp2, playerLevel,playerId,playerExp,playerGold,true,tmp);
                console.log(tmp2);
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });

}
function startMission(timeLimit, playerLevel,playerId,playerExp,playerGold,continuing,currentT) {
    const exp = timeLimit * playerLevel;
    const gold = timeLimit * playerLevel;
    if(!continuing)addMission(timeLimit,playerLevel,playerId);

    $('#missionView').html("<div class='form-group'>" +
        "    <div class='progress'>" +
        "        <div class='progress-bar' id='progressBar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='" + timeLimit + "'></div>" +
        "    </div>" +
        "</div>");

    var progressBar = document.getElementById("progressBar");
    $('#missionLabel').show();
    $('#missionView').show();
    $('#cancelBtn').show();
    $('#cancelMission').on("click", function(){ deleteMission(playerId); window.location.replace('/missions');});

    var currentTime = 0;
    if(continuing)currentTime = currentT;
    var remainingTime = Math.round(timeLimit - currentTime);
    if (remainingTime >= 10) $('#missionTime').html("<h2>00:" + remainingTime + "</h2>");
    else $('#missionTime').html("<h2>00:0" + remainingTime + "</h2>");
    progressBar.style.width = (currentTime / timeLimit * 100) + '%';
        var intervalId = setInterval(function () {
            remainingTime = Math.round(timeLimit - currentTime);
            if (currentTime >= timeLimit) {
                clearInterval(intervalId);
                progressBar.style.width = 100 + '%';
                addExperience(playerLevel, playerId, playerExp, exp, playerGold, gold);

                Swal.fire({
                    title: 'Zadanie zakończone!',
                    text: "Zdobyłeś " + exp + " pkt. doświadczenia i "+gold+" szt. złota.",
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                       checkLevelUp((playerExp + exp), playerLevel, playerId);
                        deleteMission(playerId);

                            remainingTime = 0;
                        window.location.replace('/missions');

                    }
                });



            }
            currentTime += 1;
            if (remainingTime >= 10) $('#missionTime').html("<h2>00:" + remainingTime + "</h2>");
            else $('#missionTime').html("<h2>00:0" + remainingTime + "</h2>");
            progressBar.style.width = (currentTime / timeLimit * 100) + '%';

        }, 1000);
}

