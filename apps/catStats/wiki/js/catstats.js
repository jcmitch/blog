var COLORS = [
    {
        color:"#F7464A",
        highlight: "#FF5A5E"
    },
    {
        color: "#46BFBD",
        highlight: "#5AD3D1"
    },
    {
        color: "#5602BD",
        highlight: "#682AC1"
    },
    {
        color: "#FDB45C",
        highlight: "#FFC870"
    },
    {
        color: "#08ECFF",
        highlight: "#73EDF6"
    },
    {
        color: "#6C0C6B",
        highlight: "#813380"
    },
    {
        color: "#205506",
        highlight: "#2B5E13"
    }
];

$(document).ready(function(){

    function setupPage() {
        rawData = rawData ? JSON.parse(rawData) : [];
        userOne = userOne ? JSON.parse(userOne) : {};
        userTwo = userTwo ? JSON.parse(userTwo) : {};
        var totalCats = $('.total-cats');
        totalCats.text(rawData.length);

        var userOneCount = 0,
            userTwoCount = 0;
        rawData.forEach(function(item) {
            var name = item.name;
            if (name === userOne.name) {
                userOneCount++;
            } else {
                userTwoCount++;
            }
        });
        var userOneTotalCats = $('.user-one-total-cats');
        userOneTotalCats.text(userOneCount);
        var userTwoTotalCats = $('.user-two-total-cats');
        userTwoTotalCats.text(userTwoCount);
    }

    function getSimpleDataStructure(cats, users) {
        var result = {};
        if (cats.length && users.length) {
            rawData.forEach(function(item) {
                var name = item.name.toLowerCase();
                var validUser = false;
                users.some(function(user) {
                    if (name.indexOf(user) > -1) {
                        validUser = true;
                        return true;
                    }
                });
                if (validUser) {
                    cats.some(function(cat) {
                        if (item.text.indexOf(cat) > -1) {
                            if (!result[cat]) {
                                result[cat] = {
                                    id: cat,
                                    count: 1
                                };
                            } else {
                                result[cat].count++;
                            }
                            return true;
                        }
                    });
                }
            });
        }
        return result
    }

    function updateUserPie(cats, users) {
        var userOneCount = 0;
        var userTwoCount = 0;

        if (cats.length && users.length) {
            rawData.forEach(function(item) {
                var name = item.name.toLowerCase();
                var validUser = false;
                users.some(function(user) {
                    if (name.indexOf(user) > -1) {
                        validUser = true;
                        return true;
                    }
                });
                if (validUser) {
                    cats.some(function(cat) {
                        if (item.text.indexOf(cat) > -1) {
                            if (name === userOne.name.toLowerCase()) {
                                userOneCount++;
                            } else {
                                userTwoCount++;
                            }
                            return true;
                        }
                    });
                }
            });
        }

        var curPie = $(".total-cat-pie");
        if (curPie) {
            curPie.remove();
        }
        var wrapper = $('.total-pie-wrap');
        wrapper.append('<canvas class="total-cat-pie" width="300" height="300"></canvas>');
        var ctx = $(".total-cat-pie").get(0).getContext("2d");
        var totalCatPie = new Chart(ctx).Pie([
            {
                value: userOneCount,
                label: userOne.nickname,
                color:"#0F2B51",
                highlight: "#334A69"
            },
            {
                value: userTwoCount,
                label: userTwo.nickname,
                color: "#065F5D",
                highlight: "#2A7371"
            }
        ], {animationSteps: 30, animationEasing: "linear"});
    }

    function updateTimeline(cats, users) {
        var result = {};
        if (cats.length && users.length) {
            rawData.forEach(function(item) {
                var name = item.name.toLowerCase();
                var validUser = false;
                users.some(function(user) {
                    if (name.indexOf(user) > -1) {
                        validUser = true;
                        return true;
                    }
                });
                if (validUser) {
                    cats.some(function(cat) {
                        if (item.text.indexOf(cat) > -1) {
                            if (!result[cat]) {
                                result[cat] = {
                                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                                };
                            }
                            var tmpDate = new Date(item.t);
                            if (tmpDate.getMonth() === 3) {
                                if (tmpDate.getDate() < 16) {
                                    result[cat].data[0]++;
                                } else {
                                    result[cat].data[1]++;
                                }
                            } else if (tmpDate.getMonth() === 4) {
                                if (tmpDate.getDate() < 16) {
                                    result[cat].data[2]++;
                                } else {
                                    result[cat].data[3]++;
                                }
                            } else if (tmpDate.getMonth() === 5) {
                                if (tmpDate.getDate() < 16) {
                                    result[cat].data[4]++;
                                } else {
                                    result[cat].data[5]++;
                                }
                            } else if (tmpDate.getMonth() === 6) {
                                if (tmpDate.getDate() < 16) {
                                    result[cat].data[6]++;
                                } else {
                                    result[cat].data[7]++;
                                }
                            } else if (tmpDate.getMonth() === 7) {
                                if (tmpDate.getDate() < 16) {
                                    result[cat].data[8]++;
                                } else {
                                    result[cat].data[9]++;
                                }
                            } else if (tmpDate.getMonth() === 8) {
                                if (tmpDate.getDate() < 16) {
                                    result[cat].data[10]++;
                                } else {
                                    result[cat].data[11]++;
                                }
                            } else if (tmpDate.getMonth() === 80) {
                                result[cat].data[12]++;
                            }
                            return true;
                        }
                    });
                }
            });
        }

        var processedResult = [];
        cats.forEach(function(cat, index) {
            processedResult.push({
                label: index,
                fillColor: "rgba(255,255,255,0)",
                strokeColor: COLORS[index%COLORS.length].color,
                pointColor: COLORS[index%COLORS.length].highlight,
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: result[cat] ? result[cat].data : []
            });
        });

        var data = {
            labels: ["4/6-4/15", "4/16-4/30", "5/1-5/15", "5/16-5/31", "6/1-6/15", "6/16-6/30", "7/1-7/15", "7/16-7/31", "8/1-8/15", "8/16-8/31", "9/1-9/15", "9/16-10/5"],
            datasets: processedResult
        };
        var curChart = $(".selected-cat-line");
        if (curChart) {
            curChart.remove();
        }
        var wrapper = $('.first-row');
        wrapper.append('<canvas class="selected-cat-line" width="950" height="320"></canvas>');
        var ctx = $(".selected-cat-line").get(0).getContext("2d");
        var myLineChart = new Chart(ctx).Line(data, {animationSteps: 30, responsive: true, maintainAspectRatio: false});
    }

    function updateCatPie(cats, users) {
        var result = getSimpleDataStructure(cats, users);
        var dataResult = [];

        cats.forEach(function(key, index) {
            dataResult.push({
                value: result[key] ? result[key].count : 0,
                label: index + 1,
                color: COLORS[index%COLORS.length].color,
                highlight: COLORS[index%COLORS.length].highlight
            });
        });
        var curPie = $(".selected-cat-pie");
        if (curPie) {
            curPie.remove();
        }
        var wrapper = $('.selected-pie-wrap');
        wrapper.append('<canvas class="selected-cat-pie" width="300" height="300"></canvas>');
        var ctx = $(".selected-cat-pie").get(0).getContext("2d");
        var selectedCatPie = new Chart(ctx).Pie(dataResult, {animationSteps: 30, animationEasing: "linear"});
    }

    function updateTable(cats, users) {
        var result = getSimpleDataStructure(cats, users);

        var table = $('.rank-table table');
        table.find("tr:gt(0)").remove();
        cats.forEach(function(cat, index) {
            var count = result[cat] ? result[cat].count : 0;
            table.append('<tr><td class="cat-box"><img height="75px" width="auto" src="./images/cats/'+cat+'.png"><span class="color-block" style="background-color:'+COLORS[index%COLORS.length].color+'"></span></td><td>'+count+'</td></tr>');
        });
    }

    function updateBtns() {
        var selectedBtns = $('.cat-btn.selected');
        selectedBtns.each(function(index, btn) {
            btn = $(btn);
            var numSpan = btn.find('.cat-btn-span');
            numSpan.text(index+1);
        });
    }

    function updateGraphs() {
        var selectedBtns = $('.cat-btn.selected'),
            users = $('.user-select'),
            selectedUsers = [],
            cats = [];

        users.each(function(index, chkbox) {
            if (chkbox.checked) {
                selectedUsers.push(chkbox.value);
            }
        });

        selectedBtns.each(function(index, catBtn) {
            cats.push(catBtn.getAttribute('data-id'));
        });

        updateUserPie(cats, selectedUsers);
        updateTimeline(cats, selectedUsers);
        updateCatPie(cats, selectedUsers);
        updateTable(cats, selectedUsers);
    }

    function setAllBtns() {
        var catBtns = $('.cat-btn');
        catBtns.addClass('selected');
        updateBtns();
        updateGraphs();
    }

    function clearAllBtns() {
        var catBtns = $('.cat-btn');
        catBtns.removeClass('selected');
        updateBtns();
        updateGraphs();
    }

    function getShareUrl() {
        var url = window.location.href;
        url = url.split('?')[0];

        var catBtns = $('.cat-btn');
        var btnArray = [];
        catBtns.each(function(index, btn) {
            if ($(btn).hasClass('selected')) {
                btnArray.push(index);
            }
        });

        var users = $('.user-select'),
            usrArray = [];

        users.each(function(index, chkbox) {
            if (chkbox.checked) {
                usrArray.push(chkbox.value);
            }
        });

        var btnStr;
        var usrStr;
        if (btnArray.length) {
            btnStr = btnArray.join();
        }
        if (usrArray.length) {
            usrStr = usrArray.join();
        }

        if (btnStr) {
            url += ('?cats='+btnStr);
        }
        if (usrStr) {
            url += ((btnStr ? '&' : '?') + 'usr='+usrStr);
        }
        url += '&season='+$('.season-select').val();
        window.prompt("Copy to clipboard: Ctrl+C, Enter", url);
    }

    function setLoginCookie(authed) {
        if (authed) {
            var passcode = $('.passcode').val() || '';
            $.cookie('catpass', passcode, { expires: 30 });
            location.reload(true);
        } else {
            $.cookie('catpass', 'guest', { expires: 7 });
            $('.overlay').remove();
        }
    }

    setupPage();
    updateGraphs();

    $('.cat-btn').click(function(evt){
        var target = $(evt.currentTarget);
        target.toggleClass('selected');
        updateBtns();
        updateGraphs();
    });

    $('.user-select').click(function(evt){
        updateGraphs();
    });

    $('.select-all').click(function(evt){
        setAllBtns();
    });

    $('.clear-all').click(function(evt){
        clearAllBtns();
    });

    $('.share-url').click(function(evt){
        getShareUrl();
    });

    $('.guest').click(function(evt){
        setLoginCookie(false);
    });

    $('.login').click(function(evt){
        setLoginCookie(true);
    });

    $('.season-select').on('change', function() {
      var loc = window.location;
      if (loc) {
          loc = loc.href;
          if (loc.indexOf('season=') !== -1) {
              loc = loc.substr(0,loc.indexOf('season=')) + loc.substr(loc.indexOf('season=')+12); // remove old season query param
          }
          var sep = (loc.indexOf('?') === -1) ? '?' : (loc.indexOf('?') === loc.length-1) ? '' : '&';
          window.location = loc + sep + 'season=' + this.value;
      }
    });
});