//////////////fns6////////////////////////////////////////////////////
//////////////fns6////////////////////////////////////////////////////
//////////////fns6////////////////////////////////////////////////////
//////////////fns6////////////////////////////////////////////////////

var set1 = 0;  //0色の表示をつつける,1色一回のみ
var set2 = 0;  //0色初期化する,1色初期化しない
var set3 = 3;  //連番数

function fns6(x, set1 = 0) {
  //http://www.ohtashp.com/topics/takarakuji/index_loto6.html
  var url = 'http://www.ohtashp.com/topics/takarakuji/index_loto6.html'
  if (location.href != url) {
    window.open(url);
    return;
  }
  var colors = ['#FF6666', '#99CC66', '#33FFCC', '#CC66CC', '#FFFF00', '#FF33CC', '#FF6600', '#99FF00', '#CC66CC'];
  var tb = document.getElementsByTagName('tbody')[0];
  var fc = tb.firstElementChild;
  var xca = 0;
  var ns = document.getElementsByClassName('hon');
  if (x[0] >= 10) {
    document.getElementById('c' + x[0]).click();
  } else {
    document.getElementById('c0' + x[0]).click();
  }
  do {
    var trs = fc.getElementsByTagName('td');
    if (trs.length < 3) {
      break;
    }
    var xc = 0;
    for (var i = 1; i < 7; i++) {
      for (var j = 0; j < x.length; j++) {
        if (trs[i].innerText == x[j]) {
          trs[i].style.backgroundColor = colors[j];
          xc++;
          if (set1 == 0) {
            x.splice(j, 1);
          }
        }
      }
    }

    if (xc == 3) {
      trs[0].style.backgroundColor = colors[0];
      xca++;
    }

    if (xc == 4) {
      trs[0].style.backgroundColor = colors[1];
      xca++;
    }

    if (xc == 5) {
      trs[0].style.backgroundColor = colors[2];
      xca++;
    }
  } while (fc = fc.nextElementSibling);

  if (xca > 4) {
    console.log('fns6(  [' + x + ']  )' + "  d3c = " + xca);
  }
}

function ck(x) {
  if (location.href != 'http://www.ohtashp.com/topics/takarakuji/index_loto6.html') {
    alert("URL 不正 ファンクション不正");
    return;
  }
  for (var i = 0; i < x; i++) {
    var temp = l6(6);
    if (x == 1) {
      console.log('fns6( [' + temp + '] )');
    }
    fns6(temp);
  }
}

function ad6kk(x) {
  //http://www.ohtashp.com/topics/takarakuji/index_loto6.html
  var tb = document.getElementsByTagName('tbody');
  var pf = tb[0].firstElementChild;
  var cc = pf.cloneNode(true);
  cc.getElementsByTagName('th')[0].innerText = "ADD";
  var tx = cc.getElementsByClassName('hon')
  for (var i = 0; i < 6; i++) {
    tx[i].innerText = x[i];
  }
  tb[0].insertBefore(cc, pf)
}

function rd6(x) {
  //http://www.ohtashp.com/topics/takarakuji/index_loto6.html
  var tb = document.getElementsByTagName('tbody');
  var pf = tb[0].firstElementChild;
  var tx = pf.getElementsByClassName('hon')
  for (var i = 0; i < 6; i++) {
    tx[i].innerText = x[i];
  }
}

function rm6() {
  var tb = document.getElementsByTagName('tbody');
  var pf = tb[0].firstElementChild;
  tb[0].removeChild(pf);
}

function l6(x) {
  var j = [];
  do {
    var chk = "OK";
    var c = Math.floor(Math.random() * (1 - 44) + 44);
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

function fik(x) {
  //指定の番号の列と一個前の列を表示
  //x=0の場合、すべての表示する。
  var tb = document.getElementsByTagName('tbody')[0];
  var fc = tb.firstElementChild;
  var pa = [];
  var nol = [];
  var noli = new Array(44);
  for (var i = 1; i < 44; i++) {
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
    if (temp.length < 11) {
      break;
    }
    var temp2 = [];
    for (var i = 1; i < 7; i++) {
      temp2.push(parseInt(temp[i].innerText));
    }
    if (temp2.indexOf(x) == -1) {
      fc.style.display = "none";
    } else {
      if (fc.previousElementSibling) {
        fc.previousElementSibling.style = " ";
        var t3 = fc.previousElementSibling.getElementsByTagName('td');
        for (var i = 1; i < 7; i++) {
          nol.push(parseInt(t3[i].innerText));
          if (pa.indexOf(parseInt(t3[i].innerText)) == -1) {
            pa.push(parseInt(t3[i].innerText));
          }
        }
      }
    }
  } while (fc = fc.nextElementSibling);
  console.log('fns( [' + pa.sort((a, b) => a - b) + '] )' + '  x = ' + x);
  fns6([x]);
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


//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
///https://www.takarakuji-official.jp/ec/loto6/
//ランダム取得

var ms = [];
var size = 0;
var item2;
var items;
var but;
var xx = function () {
  var url = 'https://www.takarakuji-official.jp/ec/loto6/';
  if (location.href != url) {
    window.open(url);
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
  // console.log(ms);
}

function list() {
  var funlink = new String();
  for (var i = 0; i < ms.length; i++) {
    funlink = i + '     fns6( [' + ms[i] + '] )';
    console.log(funlink);
  }
}

function fk() {
  but[0].click()
  gnum();
  // list();
}

function fkk(x) {
  var i = 0;
  var tid = setInterval(function () {
    fk();
    i++;
    if (i > x) {
      clearInterval(tid);
      list();
    }
  }, 50);
}

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////


