//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////


var set1 = 0;  //0色の表示をつつける,1色一回のみ
var set2 = 0;  //0色初期化する,1色初期化しない
var set3 = 1;  //連番数
var set4 = 10; //10 ボーナス数字含む、8 ボーナス数字含まない

function ck1() {
    set1 = 1;
    ck(1);
    set1 = 0;
}

function rfns(x) {
    set1 = 1;
    rm7();
    fns(x);
    set1 = 0;
}

var start = function () {
    var url = 'http://www.ohtashp.com/topics/takarakuji/'
    if (location.href != url) {
        window.open(url);
    }
}();

function fns(x, set1 = 0, set2 = 0, set4 = 10) {
    // xのアレーの数字を色で表示
    //http://www.ohtashp.com/topics/takarakuji/
    //https://www.mizuhobank.co.jp/retail/takarakuji/loto/loto7/index.html
    var colors = ['#FF6666', '#99CC66', '#33FFCC', '#CC66CC', '#FFFF00', '#FF33CC', '#FF6600', '#99FF00', '#CC66CC', '#ffd700', '#ff00ff', '#adff2f', '#8a2be2', '#808000', '#ff1493', '#2f4f4f', '#40e0d0'];
    var tb = document.getElementsByTagName('tbody')[0];
    var fc = tb.firstElementChild;
    var xca = 0;
    if (set2 == 0) {
        var ns = document.getElementsByClassName('hon');
        for (var i = 0; i < ns.length; i++) {
            ns[i].style = "";
        }
        var ns = document.getElementsByClassName('naka');
        for (var i = 0; i < ns.length; i++) {
            ns[i].style = "";
        }
        var ns = document.getElementsByClassName('bou');
        for (var i = 0; i < ns.length; i++) {
            ns[i].style = "";
        }
    }

    do {
        var trs = fc.getElementsByTagName('td');
        var xc = 0;
        for (var i = 1; i < set4; i++) {
            for (var j = 0; j < x.length; j++) {
                if (trs[i].innerText == x[j]) {
                    trs[i].style.backgroundColor = colors[j];
                    xc++;
                    if (set1 == 1) {
                        x.splice(j, 1);
                    }
                }
            }
        }

        if (xc == 4) {
            trs[0].style.backgroundColor = colors[0];
            xca++;
        }

        if (xc == 5) {
            trs[0].style.backgroundColor = colors[1];
            xca++;
        }


        if (xc == 6) {
            trs[0].style.backgroundColor = colors[2];
            xca++;
        }

        if (xc == 7) {
            trs[0].style.backgroundColor = colors[3];
            xca++;
        }

        if (xc == 8) {
            trs[0].style.backgroundColor = colors[4];
            xca++;
        }
    } while (fc = fc.nextElementSibling);

    if (xca > set3) {
        // console.log('fns(  [' + x.sort((a, b) => a - b) + ']  )' + "  d4c = " + xca);
        console.log('fns(  [' + x + ']  )' + "  d4c = " + xca);
    }
}

function ck(k) {
    //k回のランダム7数字を出す
    var itemp = k;
    var i = 0;
    if (k == 1) {
        if (k == 1) {
            var temp = l7(7);
            console.log('fns( [' + temp + '] )');
            console.log(nom);
            fns(temp, 1);
        }
    } else {
        work_ck = setInterval(function () {
            i++;
            if (i == k) {
                clearInterval(work_ck);
            }
            var temp = l7(7);
            fns(temp, 0);
        }, 10)
    }
}

function ad7(x) {
    //仮設番号の追加
    //http://www.ohtashp.com/topics/takarakuji/
    var tb = document.getElementsByTagName('tbody');
    var pf = tb[1].firstElementChild;
    var cc = pf.cloneNode(true);
    cc.getElementsByTagName('th')[0].innerText = "ADD";
    var ff = cc.firstElementChild.nextElementSibling.nextElementSibling;
    do {
        ff.className = "xxx";
    } while (ff = ff.nextElementSibling)
    var ff = cc.firstElementChild.nextElementSibling;
    for (var i = 0; i < 9; i++) {
        ff = ff.nextElementSibling;
        ff.innerText = x[i];
    }
    tb[1].insertBefore(cc, pf)
}

function rd7(x) {
    //仮設番号の変更
    //http://www.ohtashp.com/topics/takarakuji/
    var tb = document.getElementsByTagName('tbody');
    var pf = tb[1].firstElementChild;
    var tx = pf.getElementsByClassName('xxx')
    for (var i = 0; i < 9; i++) {
        tx[i].innerText = x[i];
    }
}

function rm7() {
    var tb = document.getElementsByTagName('tbody');
    var pf = tb[1].firstElementChild;
    tb[1].removeChild(pf);
}

function l7(x) {
    // ランダムの数字を発生
    var j = [];
    do {
        var chk = "OK";
        var c = Math.floor(Math.random() * (1 - 38) + 38);
        for (var i = 0; i < j.length; i++) {
            if (j[i] == c) {
                chk = "NG";
            }
        }
        if (chk != "NG") {
            j.push(c);
        }
    } while (j.length < x);
    return j.sort((a, b) => a - b);
}

var nom = [];  //出ないアレー
function fnm(a, b) {
    //aからb回目の再現未出数字を検索
    var xc = 0;
    var numx = [];
    // var nom = []; //出ないアレー
    var bnumx = [];
    var tb = document.getElementsByTagName('tbody')[1];
    var fc = tb.firstElementChild;
    for (var j = 1; j < 38; j++) {
        bnumx.push(j);
    }
    do {
        xc++;
        if (xc >= a && xc < a + b) {
            var temp = fc.getElementsByTagName('td');
            for (var i = 1; i < 10; i++) {
                if (numx.indexOf(parseInt(temp[i].innerText)) < 0) {
                    numx.push(parseInt(temp[i].innerText));
                    numx.sort((a, b) => a - b);
                }
            }
        } else {
            break;
        }
    } while (fc = fc.nextElementSibling);
    if (numx.length == 37) {
        console.log("37");
    } else {
        bnumx.filter(function (nx) {
            if (numx.indexOf(nx) == -1) {
                if (nom.indexOf(nx) == -1) {
                    nom.push(nx)
                }
            }
        })
    }
    console.log('fns( [' + numx + '] )');
    console.log('fns( [' + nom + '] )');
}

function fik(x) {
    //指定の番号の列と一個前の列を表示
    //x=0の場合、すべての表示する。
    var tb = document.getElementsByTagName('tbody')[0];
    var fc = tb.firstElementChild;
    var pa = [];
    var nol = [];
    var noli = new Array(38);
    for (var i = 1; i < 38; i++) {
        noli[i] = 0;
    }
    if (x == 0) {
        do {
            fc.style = "";
        } while (fc = fc.nextElementSibling);
        return null;
    }
    do {
        var temp = fc.getElementsByTagName('td');
        var temp2 = [];
        for (var i = 1; i < 10; i++) {
            temp2.push(parseInt(temp[i].innerText));
        }
        if (temp2.indexOf(x) == -1) {
            fc.style.display = "none";
        } else {
            if (fc.previousElementSibling) {
                fc.previousElementSibling.style = " ";
                var t3 = fc.previousElementSibling.getElementsByTagName('td');
                for (var i = 1; i < 10; i++) {
                    nol.push(parseInt(t3[i].innerText));
                    if (pa.indexOf(parseInt(t3[i].innerText)) == -1) {
                        pa.push(parseInt(t3[i].innerText));
                    }
                }
            }
        }
    } while (fc = fc.nextElementSibling);
    console.log('fns( [' + pa.sort((a, b) => a - b) + '] )' + '  x = ' + x);
    fns([x]);
    nol = nol.sort((a, b) => a - b)
    do {
        var i = nol.pop();
        noli[i] = noli[i] + 1;
    } while (nol.length != 0)
    console.table(noli);
    // noli.forEach(function(v,i,ar){
    //   console.log(" " + i + "   " + v);
    // })
}

function master() {
    // すべての抽選数字をarrayに取得
    var l7list = [];
    var li = 0;
    var tb = document.getElementsByTagName('tbody')[0];
    var fc = tb.firstElementChild;
    do {
        l7list[li] = [];
        var da = fc.getElementsByTagName('td');
        for (var i = 1; i < 10; i++) {
            l7list[li].push(parseInt(da[i].innerText));
        }
        li++;
    } while (fc = fc.nextElementSibling);
    return l7list;
}

function autoroll() {
    var rolldata = master();
    var work_rolldata = setInterval(function () {
        fns(rolldata.shift());
        if (rolldata.length == 0) {
            clearInterval(work_rolldata);
        }
    }, 100);
}

function manualrool(x, set1 = 0, set2 = 0, set4 = 10) {
    // 指定した回数の色をつける
    var rolldata = master();
    if (set4 == 10) {
        fns(rolldata[rolldata.length - x], set1, set2, set4);
    } else {
        rolldata[rolldata.length - x].pop();
        rolldata[rolldata.length - x].pop();
        fns(rolldata[rolldata.length - x], set1, set2, set4);
    }
}

function roolclock() {
    var rolldata = master();
    var tb = document.getElementsByTagName('tbody')[0];
    th = tb.getElementsByTagName('th');
    for (var i = 0; i < th.length; i++) {
        th[i].id = i;
        th[i].addEventListener('click', function () {
            fns(rolldata[this.id]);
        })
    }
}
roolclock();

function hiro() {
    var t = [1, 2, 3, 4, 5, 6];
    var temp = [];
    var i = 0;
    var i = 0;
    var ix = function () {
        var j = [];
        do {
            var c = Math.floor(Math.random() * (1 - 38) + 38);
            j.indexOf(c) == -1 ? j.push(c) : '';
        } while (j.length < 7);
        return j.sort((a, b) => a - b);
    };

    work_hiro = setInterval(function () {
        i++;
        var temp = ix();
        console.log(temp.toString());
        if (t.toString() === temp.toString()) {
            console.log("xxxxxxxxxxxxxxx");
            clearInterval(work_hiro);
        }
    }, 100);
}




//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//https://www.takarakuji-official.jp/ec/loto7/
//ランダム取得
var ms = [];
var size = 0;
var item2;
var items;
var but;
var xx = function () {
    var url = 'https://www.takarakuji-official.jp/ec/loto7/';
    if (location.href != url) {
        // window.open(url);
        return;
    }
    item2 = document.getElementsByClassName('m_lotteryNumContainer_item2');
    items = item2[0].getElementsByClassName('m_lotteryNumInputNum_btn is_random');
    but = item2[0].getElementsByClassName('m_btn m_lotteryNumInputFunc_btn m_btn__colorRandom m_btn__block');
}();

function gnum() {
    ms[size] = [];
    for (var i = 0; i < items.length; i++) {
        ms[size].push(parseInt(items[i].innerText, 10));
    }
    size += 1;
    return ms[ms.length - 1];
    // console.log(ms);
}

function list() {
    var funlink = new String();
    for (var i = 0; i < ms.length; i++) {
        funlink = i + '     fns([' + ms[i] + '])';
        console.log(funlink);
    }
}

function fk() {
    but[0].click()
    gnum();
    // list();
}

function fkk(x) {
    // x 回の番号を取得する
    var i = 0;
    work_fkk = setInterval(function () {
        fk();
        i++;
        if (i > x) {
            clearInterval(work_fkk);
            list();
        }
    }, 50);
}

function hero2(x) {
    // x と一致の番号を探す
    var count = 0;
    work_hiro2 = setInterval(function () {
        count++;
        but[0].click();
        var temp2 = gnum();
        if (temp2.toString() === x.toString()) {
            clearInterval(work_hiro2);
            console.log(temp2.toString());
            console.log(x.toString());
            list();
            console.log(count);
        }
    }, 50)
}

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
