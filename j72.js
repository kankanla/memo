//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////
//////////////fns7////////////////////////////////////////////////////


var set1 = 0;  //0色の表示をつつける,1色一回のみ
var set2 = 0;  //0色初期化する,1色初期化しない
var set3 = 1;  //連番数
var set4 = 10; //10 ボーナス数字含む、8 ボーナス数字含まない
var set5 = 0   //0表示 1無表示,ファイルに保存
var set6 = 0;   //0行隠ししない、1行隠しする。

function ck1() {
    set1 = 1;
    ck(1);
    set1 = 0;
}

var start = function () {
    var url = 'http://www.ohtashp.com/topics/takarakuji/'
    if (location.href != url) {
        window.open(url);
    }
}();

function fns(tx7, set1 = 0, set2 = 0, set4 = 10) {
    // xのアレーの数字を色で表示
    //http://www.ohtashp.com/topics/takarakuji/
    //https://www.mizuhobank.co.jp/retail/takarakuji/loto/loto7/index.html
    // console.log('tx7 =  ' + tx7);
    var colors = ['#FF6666', '#99CC66', '#33FFCC', '#CC66CC', '#FFFF00', '#FF33CC', '#FF6600', '#99FF00', '#CC66CC',
        '#ffd700', '#ff00ff', '#adff2f', '#8a2be2', '#808000', '#ff1493', '#2f4f4f', '#40e0d0'];
    var tb = document.getElementsByTagName('tbody')[0];
    var fc = tb.firstElementChild;
    var xca = 0;
    if (set2 == 0) {
        var ns = document.getElementsByClassName('hon');
        for (let i = 0; i < ns.length; i++) {
            ns[i].style = "";
        }
        var ns = document.getElementsByClassName('naka');
        for (let i = 0; i < ns.length; i++) {
            ns[i].style = "";
        }
        var ns = document.getElementsByClassName('bou');
        for (let i = 0; i < ns.length; i++) {
            ns[i].style = "";
        }
    }

    do {
        var trs = fc.getElementsByTagName('td');
        var xc = 0;
        for (let i = 1; i < set4; i++) {
            for (let j = 0; j < tx7.length; j++) {
                if (trs[i].innerText == tx7[j]) {
                    trs[i].style.backgroundColor = colors[j];
                    xc++;
                    if (set1 == 1) {
                        tx7.splice(j, 1);
                        master();
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

    if (xca >= set3) {
        // console.log('fns(  [' + x.sort((a, b) => a - b) + ']  )' + "  d4c = " + xca);
        console.log('fns(  [' + tx7 + ']  )' + "  d4c = " + xca);
    }
}

var cklist = [];
function ck(tx7, set5 = 0) {
    // k回のランダム7数字を出す
    // 0表示 1無表示,ファイルに保存
    // console.log('tx7 =  ' + tx7);
    var ii = 0;
    if (tx7 == 1) {
        let temp = l7(9);
        console.log('fns( [' + temp + '] )');
        console.log(nom);
        fns(temp, 1);
    } else {
        work_ck = setInterval(function () {
            if (ii > tx7) {
                clearInterval(work_ck);
                console.log('Work_Stoped');
                let temp2;
                if (set5 == 1) {
                    for (let i = 0; i < cklist.length; i++) {
                        temp2 = temp2 + cklist[i] + '\n';
                    }
                    let blob = new Blob([temp2], { type: "text/csv" });
                    let link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'cklist.txt';
                    link.click();
                }
            }

            let temp = l7(9);
            ii++;
            if (set5 == 0) {
                fns(temp, 0);
            } else {
                for (let i = 0; i < 100; ++i) {
                    ii++;
                    temp = l7(9);
                    cklist[cklist.length] = temp;
                }
            }
        }, 1)
    }
}

function ad7(tx7) {
    //仮設番号の追加
    //http://www.ohtashp.com/topics/takarakuji/
    console.log('tx7 =  ' + tx7);
    var tb = document.getElementsByTagName('tbody')[0];
    var pf = tb.firstElementChild;
    var cc = pf.cloneNode(true);
    cc.getElementsByTagName('th')[0].innerText = "ADD";
    var ff = cc.firstElementChild.nextElementSibling.nextElementSibling;
    do {
        ff.className = "xxx";
    } while (ff = ff.nextElementSibling)
    var ff = cc.firstElementChild.nextElementSibling;
    for (let i = 0; i < 9; i++) {
        ff = ff.nextElementSibling;
        ff.innerText = tx7[i];
    }
    tb.insertBefore(cc, pf)
}

function rd7(tx7) {
    //仮設番号の変更
    //http://www.ohtashp.com/topics/takarakuji/
    console.log('tx7 =  ' + tx7);
    let tb = document.getElementsByTagName('tbody')[0];
    let pf = tb.firstElementChild;
    let tt = pf.getElementsByClassName('xxx')
    for (let i = 0; i < 9; i++) {
        tt[i].innerText = tx7[i];
    }
}

function rm7() {
    let tb = document.getElementsByTagName('tbody')[0];
    let pf = tb.firstElementChild;
    let ff = pf.firstElementChild;
    let temp = '';
    do {
        temp = temp + ff.innerText + ', ';
    } while (ff = ff.nextElementSibling);
    tb.removeChild(pf);
    return temp;
}

function l7(x = 7) {
    // ランダムの数字を発生
    var j = [];
    do {
        var c = Math.floor(Math.random() * (1 - 66) + 66);
        if (c <= 37) {
            if (j.indexOf(c) == -1) {
                j.push(c);
            }
        }
    } while (j.length < x);
    return j.sort((a, b) => a - b);
}

var nom = [];  //出ないアレー
function fnm(a, b) {
    //aからb回目の再現未出数字を検索
    var xc = 0;
    var numx = [];
    var nom = []; //出ないアレー
    var bnumx = [];
    var tb = document.getElementsByTagName('tbody')[0];
    var fc = tb.firstElementChild;
    for (let j = 1; j < 38; j++) {
        bnumx.push(j);
    }
    do {
        xc++;
        if (xc >= a && xc < a + b) {
            let temp = fc.getElementsByTagName('td');
            for (let i = 1; i < 10; i++) {
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

function fik(tx7, set6 = 0) {
    //指定の番号の列と一個前の列を表示
    //x=0の場合、すべての表示する。
    var tb = document.getElementsByTagName('tbody')[0];
    var fc = tb.firstElementChild;
    var pa = [];
    var nol = [];
    var noli = new Array(38);
    for (let i = 1; i < 38; i++) {
        noli[i] = 0;
    }
    if (tx7 == 0) {
        do {
            fc.style = "";
        } while (fc = fc.nextElementSibling);
        return null;
    }
    do {
        var temp = fc.getElementsByTagName('td');
        var temp2 = [];
        for (let i = 1; i < 10; i++) {
            temp2.push(parseInt(temp[i].innerText));
        }
        if (temp2.indexOf(tx7) == -1) {
            //set6 = 0;  //0行隠ししない、1行隠しする。
            if (set6 == 1) {
                fc.style.display = "none";
            }
        } else {
            if (fc.previousElementSibling) {
                fc.previousElementSibling.style = " ";
                var t3 = fc.previousElementSibling.getElementsByTagName('td');
                for (let i = 1; i < 10; i++) {
                    nol.push(parseInt(t3[i].innerText));
                    if (pa.indexOf(parseInt(t3[i].innerText)) == -1) {
                        pa.push(parseInt(t3[i].innerText));
                    }
                }
            }
        }
    } while (fc = fc.nextElementSibling);
    console.log('fns( [' + pa.sort((a, b) => a - b) + '] )' + '  tx7 = ' + tx7);
    fns([tx7]);
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
    l7ms = [];
    let li = 0;
    let tb = document.getElementsByTagName('tbody')[0];
    let fc = tb.firstElementChild;
    do {
        l7ms[li] = [];
        let da = fc.getElementsByTagName('td');
        for (let i = 1; i < 10; i++) {
            l7ms[li].push(parseInt(da[i].innerText));
        }
        li++;
    } while (fc = fc.nextElementSibling);
    return l7ms;
}
master();

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
    for (let i = 0; i < th.length; i++) {
        th[i].id = i;
        th[i].addEventListener('click', function () {
            fns(rolldata[this.id]);
        })
    }
}
roolclock();

var hiro7_list = [];
function hiro7() {
    // ==t[] までのランダムデータをファイル作成
    console.log(new Date());
    let t = [1, 2, 3, 4, 5, 6, 7];
    var i = 0;
    hiro7_list[i] = [];
    var ix = function () {
        var j = [];
        do {
            var c = Math.floor(Math.random() * (1 - 66) + 66);
            if (c <= 37) {
                j.indexOf(c) == -1 ? j.push(c) : '';
            }
        } while (j.length < 7);
        return j.sort((a, b) => a - b);
    };

    work_hiro7 = setInterval(function () {
        let temp = ix();
        i++;
        hiro7_list[i] = temp;
        if (t.toString() === hiro7_list[i - 1].toString()) {
            console.log(new Date());
            console.log(temp);
            clearInterval(work_hiro6);
            let temp2;
            for (let i = 0; i < hiro7_list.length; i++) {
                temp2 = temp2 + 'fns(  [' + hiro7_list[i] + ']  )' + '\n';
            }
            let blob = new Blob([temp2], { type: "text/csv" });
            let link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'hiro7_list.txt';
            link.click();
        }
    }, 1);
}

//Loto7
function hiro7_view() {
    // ==t[] までのランダムデータとまる
    hiro7_item = [9, 19, 22, 32, 35, 36, 37];  //第386回
    let hiro7_item_string = hiro7_item.toString();
    let i = 0;
    function l7x() {
        let j = [];
        do {
            let c = Math.floor(Math.random() * (1 - 66) + 66);
            if (c <= 37) {
                j.indexOf(c) == -1 ? j.push(c) : '';
            }
        } while (j.length < 7);
        return j.sort((a, b) => a - b);
    }
    let startT = new Date();
    console.log(startT);

    hiro7_view_work = setInterval(() => {
        for (let li = 0; li < 1000; li++) {
            let x = l7x();
            console.log(i++, x);
            if (hiro7_item_string === x.toString()) {
                clearInterval(hiro7_view_work);
                let x = l7x();
                console.log(i++, x);
                console.log(startT);
                console.log(new Date());
                console.log('hiro7_item  ' + hiro7_item);
                console.log('Work_Stoped');
                alert("Work_Stoped");
            }
        }
    }, 500);
}
window.onbeforeunload = function () {
    return "本当に離れますか？";
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
    for (let i = 0; i < items.length; i++) {
        ms[size].push(parseInt(items[i].innerText, 10));
    }
    size += 1;
    return ms[ms.length - 1];
    // console.log(ms);
}

function list() {
    // 取得したデーターをファイルに保存
    let temp2 = new String();
    for (let i = 0; i < ms.length; i++) {
        temp2 = temp2 + ms[i] + '\n';
        // temp2 = temp2 + 'fns(  [' + ms[i] + ']  )' + '\n';
    }
    let blob = new Blob([temp2], { type: "text/csv" });
    let link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'off_hiro7_list.txt';
    link.click();
}

function fk() {
    // ひとつの番号を取得
    but[0].click()
    gnum();
    // list();
}

function fkk(x) {
    // x 回の番号を取得する
    console.log(new Date());
    var i = 0;
    work_fkk = setInterval(function () {
        fk();
        i++;
        if (i > x) {
            clearInterval(work_fkk);
            list();
            console.log(new Date());
            console.log('Work_Stoped');
        }
    }, 5);
}

function hiro7_off() {
    // x と一致の番号を探す
    hiro_off_num = [9, 19, 22, 32, 35, 36, 37];  //第386回
    let hiro7_off_num_string = hiro_off_num.toString();
    let i = 0;
    let startT = new Date();
    console.log(startT);
    work_hiro2 = setInterval(function () {
        for (let li = 0; li < 1; li++) {
            but[0].click();
            let temp2 = gnum();
            console.log(i++, temp2)
            if (hiro7_off_num_string === temp2.toString()) {
                clearInterval(work_hiro2);
                but[0].click();
                let temp2 = gnum();
                console.log(i++, temp2);
                console.lot(startT);
                console.log(new Date());
                console.log('hiro7_off_num_string  ' + hiro7_off_num_string);
                console.log('Work_Stoped');
                alert("Work_Stoped");
                list();
            }
        }
    }, 5)
}

window.onbeforeunload = function () {
    return "本当に離れますか？";
}

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

