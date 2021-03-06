<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<!-- https://hakuhin.jp/js/xmlhttprequest.html -->

<head>
    <!-- <script data-ad-client="ca-pub-0547405774182700" async
        src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <title>hello.html</title>
</head>

<body>

    <script type="text/javascript">
        const PGtitle = 'l6.html'
        const CSVFile = 'loto6.csv';
        const LMax3743 = 43;
        const LSize76 = 6;
        const LBsize79 = 7;
        const TAGLine = '---------------------------------------';
        const debug = false;
        function F_httprequest() {
            let req = new XMLHttpRequest();
            let url = '/' + CSVFile + '?key=' + Math.floor(Math.random() * (1 - 100) + 100);
            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    let ajaxText = req.responseText;
                    F_create_master(ajaxText);
                    F_read_ajax(ajaxText);
                }
            }
            req.open("GET", url, true);
            req.send(null);
        }
        // F_httprequest();

        function testFetch2() {
            let pim = fetch('/' + CSVFile + '?key=' + Math.floor(Math.random() * (1 - 100) + 100));
            pim.then(function (msg) {
                msg.text().then(function (ajaxText) {
                    console.log(TAGLine, 'step1');
                    F_create_master(ajaxText);
                    F_read_ajax(ajaxText);
                }).then(function () {
                    console.log(TAGLine, 'step2');
                }).catch(function () {
                    console.log(TAGLine, 'catch');
                })
            }).catch(function (e) {
                console.log(TAGLine, 'URLerror');
                console.log(e);
            })
        }

        async function testFetch() {
            let url = '/' + CSVFile + '?key=' + Math.floor(Math.random() * (1 - 100) + 100);
            try {
                let pri = await fetch(url);
                let csvt = await pri.text();
                F_create_master(csvt);
                F_read_ajax(csvt);
            } catch (error) {
                console.log('error');
            }
        }

        testFetch();

        function F_read_ajax(str) {
            let debug = false;
            const TAG = 'log_F_read_ajax->';
            let tr = str.split('\n');
            let ttable = document.getElementById('tb1');
            let ttfe = ttable.firstElementChild;
            ttfe = ttfe.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling;
            do {
                let tr_data = tr.shift();
                let td_data = tr_data.split(',');
                while (td_data.length < 14) {
                    td_data.push(0);
                }
                let ircc = ttfe.cloneNode(true);
                let tr_place = ircc.getElementsByTagName('td');
                let temp = [];
                for (let i = 0; i <= 12; ++i) {
                    if (i <= 1 || i >= 9) {
                        tr_place[i].innerText = td_data[i];
                    } else {
                        tr_place[i].innerText = parseInt(td_data[i]);
                        temp.push(parseInt(td_data[i]));
                    }
                }
                tr_place[13].innerText = fns2(temp, 0, 0);
                temp.pop();
                // temp.pop();
                tr_place[14].innerText = fns2(temp, 0, 0);
                ttable.insertBefore(ircc, ttfe);
            } while (tr != '');
        }

        var G_base_numsX = [];
        var G_base_numsY = [];
        function F_create_master(str) {
            // すべての抽選数字をarrayに取得
            let debug = false;
            const TAG = 'log_F_create_master->';
            if (debug) console.log(TAG, 'master');
            let tr = str.split('\n');
            let ttable = document.getElementById('tb1');
            for (let i = 0; i < tr.length; i++) {
                G_base_numsX[i] = [];
                let td = tr[i].split(',');
                while (td.length < 14) {
                    td.push(0);
                }
                for (let j = 2; j < 9; j++) {
                    G_base_numsX[i].push(parseInt(td[j]));
                }
                G_base_numsX[i].push(td[12]);
            }
            G_base_numsX.reverse();

            for (let i = 0; i <= LBsize79; i++) {
                G_base_numsY[i] = [];
                for (let j = 0; j < G_base_numsX.length; j++) {
                    // if (!isNaN(parseInt(G_base_numsX[j][i]))) {
                    //     G_base_numsY[i].push(G_base_numsX[j][i]);
                    // }
                    G_base_numsY[i].push(G_base_numsX[j][i]);
                }
            }
            if (debug) console.log(G_base_numsX);
            if (debug) console.log(G_base_numsY);
        }

        function F_colorClear(intVal) {
            //1 番号の色
            //2 日付の色
            let debug = false;
            const TAG = 'log_F_colorClear->';
            if (debug) console.log(TAG, intVal);
            switch (intVal) {
                case 1:
                    let fincol = document.getElementsByClassName('setColor');
                    for (let i = 0; i < fincol.length; i++) {
                        fincol[i].removeAttribute("style");
                    }
                    break;
                case 2:
                    let fda = document.getElementsByClassName('d');
                    for (let i = 0; i < fda.length; i++) {
                        fda[i].removeAttribute("style");
                    }
                    break;
                default:
            }
        }

        function F_colorpool(intVal) {
            // HTML Table と比較
            // http://www.htmq.com/color/websafe216.shtml
            let colors1 = {
                1: '#66FFCC', 2: '#FFCCCC', 3: '#FFCC99', 4: '#FFCC66', 5: '#FFCC33',
                6: '#FFCC00', 7: '#FF99FF', 8: '#FF99CC', 9: '#FF9999', 10: '#FF9966',
                11: '#FF9933', 12: '#FF9900', 13: '#FF66FF', 14: '#FF66CC', 15: '#FF6699',
                16: '#FF6666', 17: '#FF6633', 18: '#FF6600', 19: '#FF33FF', 20: '#FF33CC',
                21: '#FF3399', 22: '#FF3366', 23: '#FF3333', 24: '#66FF00', 25: '#FF00FF',
                26: '#FF00CC', 27: '#FF0099', 28: '#FF0066', 29: '#FF0033', 30: '#FF0000',
                31: '#CC33FF', 32: '#CC33CC', 33: '#CC3399', 34: '#CC3366', 35: '#CC3333',
                36: '#CC3300', 37: '#CC00FF', 38: '#CC00CC', 39: '#CC0099', 40: '#CC0066',
                41: '#CC0033', 42: '#CC0000', 43: '#9900FF', 44: '#9900CC',
            }
            let colors2 = {
                1: '#ffff75', 2: '#ffff70', 3: '#ffff6b', 4: '#ffff5b', 5: '#ffff4c',
                6: '#ffff3d', 7: '#ffff2d', 8: '#ffff1e', 9: '#ffff0f', 10: '#ffff00',
                11: '#75ff75', 12: '#70ff70', 13: '#6bff6b', 14: '#5bff5b', 15: '#4cff4c',
                16: '#3dff3d', 17: '#2dff2d', 18: '#1eff1e', 19: '#0fff0f', 20: '#00ff00',
                21: '#75baff', 22: '#70b7ff', 23: '#6bb5ff', 24: '#5badff', 25: '#4ca5ff',
                26: '#3d9eff', 27: '#2d96ff', 28: '#1e8eff', 29: '#0f87ff', 30: '#007fff',
                31: '#ba75ff', 32: '#b770ff', 33: '#b56bff', 34: '#ad5bff', 35: '#a54cff',
                36: '#9e3dff', 37: '#962dff', 38: '#8e1eff', 39: '#870fff', 40: '#7f00ff',
                41: '#ff7575', 42: '#ff7070', 43: '#ff6b6b', 44: '#ff5b5b', 45: '#ff4c4c',
                46: '#ff3d3d', 47: '#ff2d2d', 48: '#ff1e1e', 49: '#ff0f0f', 50: '#ff0000',
                'A': '#ff0000', 'B': '#ff007f', 'C': '#ff00ff', 'D': '#7f00ff', 'E': '#0000ff',
                'F': '#007fff', 'G': '#00ffff', 'H': '#00ff7f', 'I': '#00ff00', 'J': '#7fff00',
                'K': '#ffff00',
            }
            switch (intVal) {
                case 1:
                    return colors1;
                    break;
                case 2:
                    return colors2;
                    break;
            }
            return colors2;
        }

        function F_hit_table() {
            //
            let tb = document.getElementById('hide');
            tb.addEventListener('click', function () {
                let tab = document.getElementById('heid');
                if (tab.getAttribute('style') == 'display:none') {
                    // tab.setAttribute('style', '');
                    console.info(" document.getElementById('heid').setAttribute('style','')  ");
                    document.getElementById('heid').setAttribute('style', '');
                } else {
                    tab.setAttribute('style', 'display:none');
                }
            });
        }

        function fns2(tx, set3 = 150, view = 1) {
            // テーブルのアレと比較
            let debug = true;
            const TAG = 'log_fns2->';
            let test = G_base_numsX.concat();
            let vx = 0;
            let contA = 0;
            let contB = 0;
            for (let i = 0; i < test.length; i++) {
                contA = 0;
                for (let j = 0; j < tx.length; j++) {
                    if (test[i].indexOf(tx[j]) != -1) {
                        contA++;
                    }
                }
                if (contA >= 3) {
                    contB++;
                }
            }
            if (contB >= set3 && view == 1) {
                console.info('fns( [' + tx + '] )' + "  d3c = " + contB);
            }
            return contB;
        }

        function fns(arrayVal, set1 = 0, set2 = 0, set3 = 30, set5 = 0) {
            //
            let debug = false;
            const TAG = 'log_fns->';
            arrayVal = arrayVal.concat();
            if (!arrayVal) {
                return;
            }
            let fnsw = document.getElementById('fnsw');
            fnsw.innerText = arrayVal;
            T_show_topColor(arrayVal);

            let colors = {};
            set4 = 2;   // 色の付けモード
            switch (set4) {
                case 1:
                    colors = F_colorpool(1);
                    break;
                case 2:
                    colors = F_colorpool(2);
                    break;
                case 3:
                    for (let i = 0; i <= 50; i++) {
                        colors[i] = 'RGBA(0,0,255,' + (i / 100 + 0.3) + ')';
                    }
                    break;
            }

            let tb1 = document.getElementById('tb1');
            let fc = tb1.firstElementChild;
            let xca = 0;
            let temp = [];
            let temp2 = [];

            F_colorClear(1);
            do {
                let trs = fc.getElementsByTagName('td');
                if (trs.length < 3) {
                    break;
                }
                set5--;
                if (set5 >= 0) {
                    continue;
                };
                let xc = 0;
                // i < 9; ボーナス数字含む
                for (let i = 2; i < 9; i++) {
                    for (let j = 0; j < arrayVal.length; j++) {
                        if (trs[i].innerText == arrayVal[j]) {
                            if (temp.indexOf(arrayVal[j]) == -1) {
                                trs[i].style.backgroundColor = colors[arrayVal[j]];
                            }
                            trs[i].setAttribute('class', 'n setColor');
                            xc++;
                            if (set1 == 1) {
                                if (temp2.indexOf(arrayVal[j]) == -1) {
                                    temp2.push(arrayVal[j]);
                                } else {
                                    if (temp.indexOf(arrayVal[j]) == -1) {
                                        temp.push(arrayVal[j]);
                                    }
                                }
                            }
                        }
                    }
                }

                switch (xc) {
                    case 3:
                        trs[0].style.backgroundColor = colors[44];
                        trs[0].setAttribute('class', 'setColor');
                        xca++;
                        break;
                    case 4:
                        trs[0].style.backgroundColor = colors[45];
                        trs[0].setAttribute('class', 'setColor');
                        xca++;
                        break;
                    case 5:
                        trs[0].style.backgroundColor = colors[46];
                        trs[0].setAttribute('class', 'setColor');
                        xca++;
                        break;
                    default:
                        if (xc > 5) {
                            xca++;
                        }
                }
            } while (fc = fc.nextElementSibling);

            if (xca >= set3) {
                console.info('fns( [' + arrayVal.concat().sort((a, b) => a - b) + '] )' + '  d3c = ' + xca + ' sort');
                console.info('fns( [' + arrayVal + '] )' + '  d3c = ' + xca);
                console.info(T_toRegExp(arrayVal));
            }
        }

        function T_toRegExp(arrayVal) {
            // T_toRegExp-> (01)|(20)|(27)|(29)|(38)|(39)|(31)|(H) に出力
            // T_toRegExp-> ( 1  )|( 20 )|( 27 )|( 29 )|( 38 )|( 39 )|( 31 )|( H ) に出力
            let temp = [];
            let temp2 = [];
            const TAG = 'T_toRegExp->';
            arrayVal.forEach(function (e) {
                let nums = '';
                let nums2 = '';
                if (e <= 9) {
                    nums = '(0' + e + ')';
                    nums2 = '( ' + e + '  )'
                } else {
                    nums = '(' + e + ')';
                    nums2 = '( ' + e + ' )'
                }
                temp.push(nums);
                temp2.push(nums2);
            })
            // console.log(TAG, temp.toString().replaceAll(',', '|'));
            // 正規表現
            // /g 正規表現すべて選択
            console.log(TAG, temp.toString().replace(/,/g, '|'));
            console.log(TAG, temp2.toString().replace(/,/g, '|'));
        }

        function T_cpt2(arrayVal = [0, 0, 0, 0, 0, 0, 0], nid = 5) {
            // T_cpt2() 先頭に予想番号を追加
            let debug = false;
            const TAG = 'log_T_cpt2->';
            if (debug) console.log(TAG, 'step1');
            let xnid = document.getElementById('nx' + nid);
            let cxnid = xnid.getElementsByClassName('n');
            if (arrayVal.length < LBsize79) {
                for (let i = arrayVal.length; i < LBsize79; i++) {
                    arrayVal.push(0);
                }
            }
            for (let i = 0; i < cxnid.length; i++) {
                cxnid[i].innerText = arrayVal[i];
            }
            let temp = xnid.firstElementChild;
            for (let i = 0; i < 13; i++) {
                temp = temp.nextElementSibling;
            }
            temp.previousElementSibling.innerText = G_base_numsY[G_base_numsY.length - 1][0];

            let tempar = arrayVal.splice(',');
            let tempar1 = [];
            tempar.forEach(function (e) {
                tempar1.push(parseInt(e));
            });
            temp.innerText = fns2(tempar1);
            fns(tempar1, 1);
            tempar1.pop();
            // tempar1.pop();
            temp.nextElementSibling.innerText = fns2(tempar1);

            // KeySearch() 表示用
            let tabletag = document.getElementById('tb6');
            let num = tabletag.getElementsByClassName('n');
            for (let i = 0; i < tempar1.length; i++) {
                num[i].innerText = tempar1[i];
            }
        }

        G_groupNums = [];
        function T_L6ck5(numsAry = [], markInt = 66) {
            //2021/02/28
            let TAG = 'log_T_ck5->';
            let T5count = 0;
            if (numsAry.length == 0) {
                console.log('isNull');
                G_groupNums = [];
                return;
            }
            G_groupNums = numsAry;
            WT_ck5 = setInterval(function () {
                let temp = G_lsloop.concat();
                let tcont = 0;
                temp.pop();
                for (let i = 0; i < temp.length + 1; i++) {
                    if (G_groupNums.indexOf(temp[i]) > -1) {
                        tcont++;
                    }
                }

                if (tcont == 5) {
                    for (let i = 0; i < temp.length + 1; i++) {
                        if (G_groupNums.indexOf(temp[i]) > -1) {
                            G_groupNums.splice(G_groupNums.indexOf(temp[i]), 1);
                            tcont--;
                        }
                    }
                    T5count++;
                    console.log(temp);
                    console.log(G_groupNums);
                    temp.push(markInt);
                    if (tcont == 0) {
                        localStorage_additem(temp);
                    }
                } else {
                    tcont = 0;
                }
                if (T5count == 5) {
                    clearInterval(WT_ck5);
                } else {
                    console.info('  clearInterval(WT_ck5) ');
                }
            }, 500);
        }

        let G_L6ck4nums = [];
        function T_L6ck4(remNums = []) {
            // L6 向く
            let debug = false;
            let TAG = 'log_T_ck4->'
            let fnum = [];
            G_L6ck4nums = [];
            if (typeof (WT_ck4) == 'number') {
                clearInterval(WT_ck4);
            }

            for (let i = 0; i < LMax3743; i++) {
                G_L6ck4nums.push(parseInt(i) + 1);
            }

            if (remNums.length > -1) {
                remNums.forEach(function (e) {
                    G_L6ck4nums.splice(G_L6ck4nums.indexOf(e), 1);
                })
            }

            WT_ck4 = setInterval(function () {
                let tempnum = G_lsloop.concat();
                tempnum.pop();
                let count = 0;

                tempnum.forEach(function (e) {
                    if (G_L6ck4nums.indexOf(e) >= 0) {
                        count++;
                    }
                })
                if (count == 6) {
                    tempnum.forEach(function (e) {
                        G_L6ck4nums.splice(G_L6ck4nums.indexOf(e), 1);
                    });
                    console.log("STEP1", tempnum);
                    fnum.push(tempnum);
                    tempnum.push(0);
                    localStorage_additem(tempnum);
                    console.log("STEP2", G_L6ck4nums);
                } else {
                    count = 0;
                    console.log(TAG, '  clearInterval(WT_ck4)  ');
                }
                if (G_L6ck4nums.length < 6) {
                    clearInterval(WT_ck4);
                    console.log(TAG, fnum);
                    console.info(TAG, G_L6ck4nums);
                }
            }, 100);
        }

        function T_ck3(arrayVal, view = 0) {
            // T_ck3() 設定番号除外して予想番号を生成
            let debug = false;
            const TAG = 'log_T_ck3->'
            if (debug) console.log(TAG, 'T_ck3');
            let orj = arrayVal;
            let nums = [];
            let nlist = [];
            let count = 0;
            for (let i = 0; i < LMax3743; i++) {
                nums.push(parseInt(i) + 1);
            }

            for (let i = 0; i < orj.length; i++) {
                nums.splice(nums.indexOf(parseInt(orj[i])), 1);
            }
            var flag = 0;
            nlist.push(orj);
            W_ck3 = setInterval(function () {
                for (let j = 0; j < 100; j++) {
                    let tp = ls(LSize76);
                    if (view == 1) {
                        console.log(TAG, count++ + '  ' + tp);
                    } else {
                        count++;
                    }
                    for (let i = 0; i < tp.length; i++) {
                        if (nums.indexOf(parseInt(tp[i])) === -1) {
                            flag = 1;
                        }
                    }

                    if (flag == 0) {
                        nlist.push(tp);
                        console.log(TAG, nums);
                        console.log(count, tp);
                        tp.forEach(function (e) {
                            nums.splice(nums.indexOf(parseInt(e)), 1);
                        })
                    } else {
                        flag = 0;
                    }
                    if (nums.length <= tp.length) {
                        clearInterval(W_ck3);
                        console.log(TAG, nums);
                        nlist.push(nums);
                        // console.log(nlist);
                        console.log(TAG, new Date());
                        console.log(TAG, 'count ' + count);
                        nlist.forEach(function (e) {
                            console.log(TAG, 'fns([' + e + '])');
                        })
                        console.log(TAG, 'W_ck3_stoped');
                        alert("W__ck3_stoped");
                        break;
                    }
                }
            }, 100)
        }

        function T_ck2(intVal, set3 = 150) {
            // T_ck2() 予想番号を生成,masterと参照
            // ランダム番号を生成
            let debug = false;
            const TAG = 'log_T_ck2->';
            console.info(new Date());
            W_ck2 = setInterval(function () {
                for (let i = 0; i < 1; i++) {
                    if (intVal-- >= 0) {
                        // let temp = ls(LBsize79);
                        let temp = G_lsloop.concat();
                        fns2(temp, set3);
                    }
                }
                if (intVal <= 0) {
                    clearInterval(W_ck2);
                    console.info(TAG, new Date());
                    console.info(TAG, 'W_ck2_end');
                }
            }, 2000);
        }

        function T_ck(intVal = 1, set3 = 150) {
            // T_ck() 予想番号を生成,htmlと参照
            let debug = false;
            const TAG = 'log_T_ck->';
            W_ck = setInterval(function () {
                // let temp = ls(LBsize79);
                let temp = G_lsloop.concat();
                if (intVal == 1) {
                    console.info(TAG, 'fns( [' + temp + '] )');
                    T_cpt2(temp);
                }
                fns(temp, 1);
                // fns(temp, 0, 0, set3);
                if (intVal-- <= 1) {
                    clearInterval(W_ck);
                    console.info(TAG, 'W_ck_end');
                }
            }, 1);
        }

        G_addr = []
        function T_addr(arrayVal, show = 0) {
            // T_addr() []番号を追加,番号の出番を確認
            // よく表示する数字を割り出す
            let debug = false;
            const TAG = 'log_T_addr->';
            G_addr = G_addr.concat(arrayVal);
            G_addr.sort((a, b) => a - b);
            let temp = [];
            for (let j = 0; j <= LMax3743; j++) {
                temp[j] = 0;
            }
            G_addr.forEach(function (e) {
                temp[e] = temp[e] + e + ',';
            });
            if (show == 1) {
                if (G_addr.length < 200) {
                    temp.forEach(function (e) {
                        if (e != 0) {
                            console.info(e);
                        }
                    })
                    console.info(TAG, 'fns( [' + G_addr + '])');
                    console.info(TAG, 'G_addr=[] reset');
                }
            }
        }

        var G_lsloop = [];
        var G_num_filter = [];   //番号フィルタ
        var G_base_numsY = [];

        function T_GetnextNums(intVal, intIndex) {
            let testkey = intVal;
            let index = intIndex;
            let numsArray = [];
            if (testkey == 0 || index == (LBsize79 - 1)) {
                numsArray = G_base_numsY[index];
            } else {
                for (let i = 0; i < G_base_numsY[index].length; i++) {
                    if (G_base_numsY[index - 1][i] == testkey) {
                        numsArray.push(G_base_numsY[index][i]);
                    }
                }
            }
            let temp = numsArray.concat();
            temp.reverse();
            return temp;
        }

        //l7.html:294 fns( [2,16,25,12,33,5,20,29,31,4] )  d3c = 55
        function F_lsloop(intval = LBsize79, algorithm = 1) {
            // 循環にランダム番号を生成する、抽選番号マスターアレーを2次元配列と参照する．
            let debug = false;
            const TAG = 'log_F_lsloop->';
            let p1 = document.getElementById('p1');
            let p2 = document.getElementById('p2');
            let count = 0;

            W_lsloop = setInterval(function () {
                // clearInterval(W_lsloop);
                let bnum = [];
                let numTemp = 0;
                let errorCount = 0;
                let randomIndex = 0;
                let nums = [];
                do {
                    switch (algorithm) {
                        case 1:
                            // 出た番号と次の番号と組み合わせを参考する，
                            // 20201212 から利用一時停止
                            nums = T_GetnextNums(numTemp, bnum.length);
                            break;
                        case 2:
                            // 列を参考して番号を探し
                            nums = G_base_numsY[bnum.length];
                            break;
                        case 3:
                            //最近の番号のみ参照
                            // 20210209 作成
                            nums = T_GetnextNums(0, bnum.length);
                            nums = nums.slice(0, 20);
                            break;
                    }

                    randomIndex = Math.floor(Math.random() * (0 - nums.length) + nums.length);
                    if (bnum.length == 0) {
                        let tempnumTemp = nums[randomIndex];
                        if (G_num_filter.indexOf(tempnumTemp) == -1) {
                            bnum.push(tempnumTemp);
                            numTemp = tempnumTemp;
                        }
                    } else {
                        let tempnumTemp = nums[randomIndex];
                        if (parseInt(tempnumTemp) > parseInt(bnum[bnum.length - 1])) {
                            if (G_num_filter.indexOf(tempnumTemp) == -1) {
                                bnum.push(tempnumTemp);
                                numTemp = tempnumTemp;
                            }
                        } else {
                            if (debug) console.log(TAG + 'bnum.length', bnum.length);
                            if (debug) console.log(TAG, bnum[bnum.length - 1] + '<<<' + tempnumTemp);
                            if (debug) console.log(TAG, 'T_GetnextNums([' + bnum[bnum.length - 1] + ',' + bnum.length + '])');
                        }
                    }

                    if (bnum.length > 1 && debug) {
                        console.assert(bnum[bnum.length - 1] > bnum[bnum.length - 2]);
                    }
                    if (errorCount++ > 9000) {
                        break;
                    }
                } while (bnum.length < LBsize79 - 1);
                errorCount = 0;

                do {
                    // ボーナス数字
                    let nums = T_GetnextNums(numTemp, bnum.length);
                    randomIndex = Math.floor(Math.random() * (0 - nums.length) + nums.length);
                    let tempnumTemp = nums[randomIndex];
                    if (bnum.indexOf(tempnumTemp) == -1 && G_num_filter.indexOf(tempnumTemp) == -1) {
                        bnum.push(tempnumTemp);
                        numTemp = tempnumTemp;
                    }
                    if (errorCount++ > 9000) {
                        break;
                    }
                    numTemp = 0;
                } while (bnum.length < LBsize79)
                errorCount = 0;

                if (bnum.length == LBsize79) {
                    G_lsloop = bnum.concat();
                    p1.innerText = count++;
                    p2.innerText = G_lsloop;
                }
            }, 100)

            function tfn(intVal) {
                // 指定回数の番号を発生する。
                // T_baseReport(new T_toYaxis(temp).value);
                // T_baseReport(G_base_numsY);
                temp = [];
                let work = setInterval(function () {
                    temp[temp.length] = G_lsloop;
                    if (temp.length == intVal) {
                        clearInterval(work);
                    }
                }, 100)
            }

            function tfn2() {
                // 番号の間違い探し
                let work = setInterval(() => {
                    let temp = G_lsloop;
                    console.log(temp);
                    for (let i = 0; i < G_lsloop.length - 2; i++) {
                        console.log(temp[i], temp[i + 1]);
                        if (temp[i] > temp[i + 1]) {
                            console.log('TAG---');
                            clearInterval(work);
                        }
                    }
                }, 500);
            }

            function tfn3() {
                // Loto6 の場合e.length - 2
                // Loto7 の場合e.length - 3
                // 番号マスターの間違い探し
                let temp = G_base_numsX.concat();
                temp.forEach(function (e) {
                    for (let i = 0; i < e.length - 2; i++) {
                        if (e[i] >= e[i + 1]) {
                            console.log('TAG---');
                            console.log(e[i], e[i + 1]);
                            console.log(e);
                        }
                    }
                })
                console.log("tfn3,end");
            }

            function tfn4() {
                // 発生番号は抽選できる番号は出るか
                // 発生した番号はすべてのマスターと比較する
                // clearInterval(tfn4_work)
                const TAG = 'tfn4->';
                let temp = G_base_numsX.concat();
                tfn4_tempArray = [];
                tfn4_cont = 0;
                tfn4_tfn4_work = setInterval(function () {
                    tfn4_cont++;
                    tfn4_temp2 = G_lsloop.concat().toString();
                    // tfn4_temp2 = ls(LBsize79);  // 旧方法
                    // console.info(TAG + cont + '->' + tempArray.length, temp2);
                    temp.forEach(function (e) {
                        if (e.toString() == tfn4_temp2) {
                            tfn4_tempArray.push(tfn4_temp2);
                        }
                    })
                    if (tfn4_tempArray.length == 3) {
                        clearInterval(tfn4_tfn4_work);
                        console.info(TAG, tfn4_tempArray);
                        console.info(TAG, tfn4_cont);
                    }
                }, 100)
            }
        }

        function T_toYaxis(arrayVal) {
            // T_baseReport(new T_toYaxis(G_LocalMaster).value,1,1);
            let temp = [];
            for (let i = 0; i < arrayVal[arrayVal.length - 1].length; i++) {
                temp[i] = [];
                for (let j = 0; j < arrayVal.length; j++) {
                    temp[i].push(arrayVal[j][i]);
                }
            }
            this.value = temp;
        }

        function T_baseReport(arrayVal, start = 0, end = 0) {
            // arrayVal 統計するアレー,Y軸
            // start ,end  アレーの長さ
            // T_baseReport(new T_toYaxis(G_LocalMaster).value,1,1);
            let debug = false;
            const TAG = 'log_T_baseReport->';
            let aVal = JSON.parse(JSON.stringify(arrayVal));
            let G_base = [];
            let G_base2 = [];
            if (start != 0) {
                for (let i = 0; i < LSize76 + 2; i++) {
                    let st = aVal[i].length - start;
                    let en = st + end;
                    aVal[i] = aVal[i].reverse().slice(st, en);
                }
            }

            if (debug) console.log(TAG, aVal);
            if (debug) console.log(arrayVal);
            for (let i = 1; i < LMax3743 + 1; i++) {
                G_base[i] = [];
                G_base2[i] = [];
                for (let j = 0; j < aVal.length; j++) {
                    let temp = aVal[j].filter(x => x == i);
                    let temp2 = G_base_numsY[j].filter(x => x == i);
                    G_base[i][j] = temp.length + '  (' + temp2.length + ')';
                    G_base2[i][j] = temp.length;
                }
            }
            T_toTable(G_base);
            console.info(TAG, TAGLine);
            console.table(G_base2);
            console.info(TAG, aVal);
            console.info(TAG, TAGLine);
        }

        function T_toTable(arrayVal) {
            // T_baseReport to htmltable
            let tabera = document.getElementById('x6');
            let temp = '';
            for (let i = 1; i < arrayVal.length; i++) {
                temp = temp + '<tr>';
                temp = temp + '<td width="88">' + i + '</td>';
                for (let j = 0; j < arrayVal[arrayVal.length - 1].length; j++) {
                    xx = arrayVal[i][j];
                    if (xx == '0  (0)') {
                        temp = temp + '<td width="88">' + ' ' + '</td>';
                    } else {
                        if (xx.slice(0, 1) == 0) {
                            temp = temp + '<td width="88">' + xx + '</td>';
                        } else {
                            temp = temp + '<td width="88" style="background-color: rgb(162 245 204)">' + xx + '</td>';
                        }
                    }
                }
                temp = temp + '</tr>';
            }
            tabera.innerHTML = '<table table border="1" cellspacing="3"  cellpadding="0" bordercolor="#333333" style="display:"" ' + temp + '</table>';
        }

        function T_NUMunionReport(intVal, intVal2) {
            // T_NUMunionReport
            // intVal; 確認する数字
            // intVal2; 確認する数字の位置(0,8),9位置と関係しない
            // numtag と よく一緒に出る数字を探し
            const TAG = 'T_NUMunionReport->';
            let numtag = intVal;
            let temp = G_base_numsX.concat();
            let tcon = [];
            for (let i = 1; i <= LMax3743; i++) {
                tcon[i] = [];
                for (let j = 0; j < LSize76 + 1; j++) {
                    tcon[i][j] = 0;
                }
            }
            temp.forEach(function (e) {
                if (intVal2 == 9) {
                    if (e.indexOf(numtag) >= 0) {
                        for (let i = 0; i < LSize76 + 1; i++) {
                            tcon[e[i]][i] = tcon[e[i]][i] + 1;
                        }
                    }
                } else {
                    if (e.indexOf(numtag) == intVal2) {
                        for (let i = 0; i < LSize76 + 1; i++) {
                            tcon[e[i]][i] = tcon[e[i]][i] + 1;
                        }
                    }
                }
            })

            tcon.forEach(function (e) {
                let xcont = 0;
                for (let i = 0; i < e.length; i++) {
                    xcont = xcont + e[i];
                }
                e[e.length - 1] = xcont;
            })
            console.info(TAG, numtag + '番号とよく一緒に出る数字を探し');
            console.table(tcon);
        }

        function T_nextLoto(arrayVal) {
            // 回連続出番号,前回と同じ列同じ番号出る率
            // T_nextLoto(G_base_numsY[2])
            const TAG = 'T_nextLoto->';
            let tagArray = arrayVal.concat();
            let numTemp = [];
            for (let i = 1; i <= LMax3743; i++) {
                let tagNum = i;
                let count = 0;
                for (let j = 0; j < tagArray.length; j++) {
                    if (tagArray[j] == tagNum && tagArray[j + 1] == tagNum) {
                        count++;
                    }
                }
                if (count != 0) {
                    numTemp[i] = count;
                }
            }
            console.info(TAG, '回連続出番号,前回と同じ列同じ番号出る率');
            console.table(numTemp);
        }

        function T_nextLotoUp(arrayVal, intVal) {
            // 同じ列の番号の次に出る番号の率
            // arrayVal　列,番号番号
            // T_nextLoto(G_base_numsY[0],1)
            const TAG = 'T_nextLotoUp->';
            let tagArray = arrayVal.concat().reverse();
            let numTemp = [];
            for (let i = 1; i <= LMax3743; i++) {
                numTemp[i] = 0;
            }
            for (let i = 1; i <= tagArray.length; i++) {
                if (intVal == tagArray[i]) {
                    console.info(intVal, tagArray[i - 1]);
                    numTemp[tagArray[i - 1]] = numTemp[tagArray[i - 1]] + 1;
                }
            }

            do {
                numTemp.pop();
            } while (numTemp[numTemp.length - 1] == 0);
            console.log(TAG, '同じ列の番号の次に出る番号の率');
            console.table(numTemp);
            console.info(numTemp);
        }

        function T_nextLotoDown(arrayVal, intVal) {
            // 同じ列の番号の次に出る番号の率
            // arrayVal　列,番号番号
            // T_nextLoto(G_base_numsY[0],1)
            let tagArray = arrayVal.concat().reverse();
            let numTemp = [];
            for (let i = 1; i <= LMax3743; i++) {
                numTemp[i] = 0;
            }
            for (let i = 1; i < tagArray.length; i++) {
                if (intVal == tagArray[i]) {
                    if (!isNaN(tagArray[i + 1])) {
                        console.info(intVal, tagArray[i + 1]);
                        numTemp[tagArray[i + 1]] = numTemp[tagArray[i + 1]] + 1;
                    }
                }
            }

            do {
                numTemp.pop();
            } while (numTemp[numTemp.length - 1] == 0);
            console.table(numTemp);
            console.log(numTemp);
        }

        function F_lsloop2(intval = LBsize79) {
            // 循環にランダム番号を生成する、抽選番号マスターアレーを1次元配列と参照する．
            let debug = true;
            const TAG = 'log_F_lsloop->';
            let p1 = document.getElementById('p1');
            let p2 = document.getElementById('p2');
            let count = 0;
            let base_nums = [];
            for (let i = 1; i < G_base_numsX.length; i++) {
                for (let j = 1; j < G_base_numsX[i].length; j++) {
                    base_nums.push(G_base_numsX[i][j]);
                }
            }

            console.info(TAG + 'base_nums = ', base_nums);
            if (base_nums.length == 0) {
                F_lsloop(LBsize79);
                console.info(TAG, 'base_nums.length =  ' + base_nums.length);
            }
            W_lsloop = setInterval(function () {
                let j = [];
                do {
                    let x_axis = Math.floor(Math.random() * (1 - base_nums.length) + base_nums.length);
                    let c = base_nums[x_axis];
                    if (c <= LMax3743) {
                        if (j.indexOf(c) == -1 && G_num_filter.indexOf(c) == -1) {
                            j.push(c);
                        }
                    }
                } while (j.length < intval);
                if (j.length == LBsize79) {
                    G_lsloop = j.concat();
                    G_lsloop.sort((a, b) => a - b);
                    p1.innerText = count++;
                    p2.innerText = G_lsloop;
                }
            }, 10)
        }

        function F_lsloop_old2(intval = LBsize79) {
            //循環にランダム番号を生成,抽選番号マスターアレーと参照する．
            //
            let debug = false;
            const TAG = 'log_F_lsloop_old2->';
            let p1 = document.getElementById('p1');
            let p2 = document.getElementById('p2');
            let count = 0;
            W_lsloop = setInterval(function () {
                let j = [];
                do {
                    let x1 = Math.floor(Math.random() * (1 - G_base_numsX.length) + G_base_numsX.length);
                    let x2 = Math.floor(Math.random() * (1 - LBsize79) + LBsize79);
                    let c = G_base_numsX[x1][x2];
                    if (debug) console.log(TAG, x1 + '   ' + x2 + '   ' + c);
                    if (c <= LMax3743) {
                        if (j.indexOf(c) == -1 && G_num_filter.indexOf(c) == -1) {
                            j.push(c);
                        }
                    }
                } while (j.length < intval);
                if (j.length == LBsize79) {
                    G_lsloop = j.concat();
                    G_lsloop.sort((a, b) => a - b);
                    p1.innerText = count++;
                    p2.innerText = G_lsloop;
                }
            }, 10)

            //テストコード
            while (false) {
                x_axis = Math.floor(Math.random() * (1 - G_base_numsX.length) + G_base_numsX.length);
                y_axis = Math.floor(Math.random() * (1 - LBsize79) + LBsize79);
                console.log(G_base_numsX[x_axis][y_axis]);
                if (G_base_numsX[c][d] == 37) {
                    break;
                }
            }

            //テストコード
            function t1() {
                let ttx = [];
                var tts = setInterval(function () {
                    c = G_lsloop.concat();
                    for (let i = 0; i < c.length; i++) {
                        ttx.push(c[i]);
                        ttx.sort((a, b) => a - b);
                    }
                    if (ttx.length > 1000) {
                        alert("clean");
                        clearInterval(tts);
                    }
                }, 500);
            }
        }

        function ls(intVal = LBsize79) {
            // G_base_numsYと参照する。
            let bnum = [];
            let randomIndex = 0;
            let numTemp = 0;
            let errorCount = 0;

            do {
                // 本番数字
                randomIndex = Math.floor(Math.random() * (1 - G_base_numsY[0].length) + G_base_numsY[0].length);
                if (bnum.length == 0) {
                    numTemp = G_base_numsY[bnum.length][randomIndex];
                    if (G_num_filter.indexOf(numTemp) == -1) {
                        bnum.push(numTemp);
                    }
                } else {
                    numTemp = G_base_numsY[bnum.length][randomIndex];
                    if (bnum.indexOf(numTemp) == -1 && numTemp > bnum[bnum.length - 1] && G_num_filter.indexOf(numTemp) == -1) {
                        bnum.push(numTemp);
                    }
                }
                if (errorCount++ > 9000) {
                    break;
                }
            } while (bnum.length < LBsize79 - 1);
            errorCount = 0;

            do {
                // ボーナス数字
                randomIndex = Math.floor(Math.random() * (1 - G_base_numsY[0].length) + G_base_numsY[0].length);
                numTemp = G_base_numsY[bnum.length][randomIndex];
                if (bnum.indexOf(numTemp) == -1 && G_num_filter.indexOf(numTemp) == -1) {
                    bnum.push(numTemp);
                }
                if (errorCount++ > 9000) {
                    break;
                }
            } while (bnum.length < LBsize79)
            errorCount = 0;
            if (bnum.length == LBsize79) {
                return bnum;
            }
        }

        function T_ncont() {
            // すべての出番数字の合計,コンソールにテーブル表示
            let debug = false;
            const TAG = 'log_T_ncont->';
            let table = [];
            if (G_addr.length == 0) {
                for (let i = 0; i < G_base_numsX["length"]; i++) {
                    T_addr(G_base_numsX[i]);
                }
            }

            for (var i = 1; i <= LMax3743; i++) {
                var temp = 0;
                G_addr.forEach(function (e) {
                    if (e == i) {
                        temp++;
                    }
                })
                table[i] = temp;
            }
            console.info(TAG, TAGLine);
            console.info(TAG, table);
            console.table(table);
            console.info(TAG, TAGLine);
        }

        function T_topNum(intVal = 1, top10 = 0) {
            // 番号の出番順位を割り出す
            // intVal=1 高い順 =2 低い順
            // top10 統計の回数
            let debug = false;
            const TAG = 'log_T_topNum->';
            let table = [];
            if (G_addr.length == 0) {
                if (top10 == 0) {
                    for (let i = 0; i < G_base_numsX["length"]; i++) {
                        T_addr(G_base_numsX[i]);
                    }
                }
                if (top10 > 0) {
                    if (debug) console.log(TAG, G_base_numsX["length"] - 1);
                    if (debug) console.log(TAG, G_base_numsX["length"] - top10);
                    for (let i = G_base_numsX["length"] - 1; i > G_base_numsX["length"] - top10; i--) {
                        T_addr(G_base_numsX[i]);
                    }
                }
            }

            for (var i = 1; i <= LMax3743; i++) {
                var temp = 0;
                G_addr.forEach(function (e) {
                    if (e == i) {
                        temp++;
                    }
                })
                table[i] = [i, temp];
            }
            if (debug) console.log(TAG, G_addr);
            G_addr = [];
            if (debug) console.table(table);
            switch (intVal) {
                case 1:
                    table.sort((a, b) => a[1] - b[1]);
                    break;
                case 2:
                    table.sort((b, a) => a[1] - b[1]);
                    break;
            }
            return table;
        }

        function T_ncont2(arrayVal = []) {
            // 出番と購入の比較
            let debug = false;
            const TAG = 'log_T_ncont2';
            if (arrayVal.length > 0) {
                T_addr(arrayVal);
            }

            let table = [];
            for (let i = 1; i <= LMax3743; i++) {
                table[i] = [0, 0];
            }

            for (let i = 0; i < G_addr.length; i++) {
                G_addr.forEach(function (e) {
                    if (i == e) {
                        table[i][0]++;
                    }
                })
            }

            G_addr = [];
            if (G_addr.length == 0) {
                for (let i = 0; i < G_base_numsX["length"]; i++) {
                    T_addr(G_base_numsX[i]);
                }
            }

            for (let j = 0; j < G_addr.length; j++) {
                G_addr.forEach(function (e) {
                    if (j == e) {
                        table[j][1]++;
                    }
                })
            }

            console.info(TAG, TAGLine);
            console.table(table);
            console.info(TAG, TAGLine);
            for (let i = 1; i <= LMax3743; i++) {
                var a = '';
                for (let t1 = 1; t1 < table[i][0]; t1++) {
                    a = a + 'O';
                }
                console.info(i, a);

                var b = '';
                for (let t2 = 1; t2 < table[i][1] - 200; t2++) {
                    b = b + '>';
                }
                console.info(i, '200+' + b);
            }
            for (let i = 1; i <= LMax3743; i++) {
                console.info(i + ',' + table[i][0] + ',' + table[i][1]);
            }
        }

        function T_rns(arrayVal) {
            // 番号を回転する。
            let debug = false;
            const TAG = 'log_T_rns->';
            let temp = [];
            let ttx = arrayVal.concat();
            for (let i = 0; i <= LMax3743; i++) {
                if (arrayVal[i]) {
                    temp[i] = LMax3743 + 1 - ttx[i];
                }
            }
            console.info('fns( [' + temp + '] )');
        }

        function T_NumFix(intVal, indexInt) {
            // 行の番号を固定し、一緒に出る場号でランダムで番号を作成できる
            // JSON.parse(JSON.stringify(arrayVal));
            let debug = true;
            const TAG = 'T_NumFix->';
            let tnum = JSON.parse(JSON.stringify(G_base_numsX));
            let bbx = [];
            let bby = [];
            tnum.filter(function (e) {
                if (intVal != 0) {
                    if (e[indexInt] == intVal) {
                        bbx.push(e);
                    }
                } else {
                    bbx.push(e);
                }
            });
            bby = new T_toYaxis(bbx);
            G_base_numsY = bby.value;
            console.info(G_base_numsY);
        }

        function T_BallMask(charArray) {
            // Ball ['A','B','C','D','E','F','G','H','I','J']
            // 指定ボールの結果を除外する。 /////////////////////////////
            // let mask = ['A','B','C','D','E','F','H','I','J']
            let debug = true;
            const TAG = 'T_BallMask->';
            let mask = charArray;
            let temp = [];
            let bby = [];
            let tnum = JSON.parse(JSON.stringify(G_base_numsX));
            temp.push(tnum.filter(function (e) {
                return mask.indexOf(e[e.length - 1]) == -1;
            }));
            bby = new T_toYaxis(temp[0]);
            G_base_numsY = bby.value;
            console.info(G_base_numsY);
        }

        function T_NumMask(intVal, indexInt) {
            // invVal, indexInt
            // partemp.setAttribute('style', 'display:none');
            // console.info("document.getElementById('heid').setAttribute('style','')");
            let tb1 = document.getElementById('tb1');
            let tb1f = tb1.firstElementChild;
            do {
                let temp = tb1f.firstElementChild;
                let partemp = temp.parentElement;
                if (parseInt(partemp.firstElementChild.innerText) > 0) {
                    if (intVal > 0) {
                        // reset
                        partemp.setAttribute('style', 'display:none');
                    } else {
                        partemp.setAttribute('style', '');
                    }
                }
                for (let i = 0; i < indexInt + 2; i++) {
                    temp = temp.nextElementSibling
                }
                if (parseInt(temp.innerText) == intVal) {
                    partemp.setAttribute('style', '');
                }
            } while (tb1f = tb1f.nextElementSibling);
        }

        function T_balanceSearch(va0, va1, va2) {
            //T_balanceSearch(va0[,], va2[,], va3[,]) 
            let debug = false;
            let TAG = 'T_balanceSearch-> ';
            let temp = [];
            if (typeof (W_T_balanceSearch) == 'number') {
                clearInterval(W_T_balanceSearch);
            }
            W_T_balanceSearch = setInterval(() => {
                temp = G_lsloop.concat();
                if (temp[va0[0]] >= va0[1] && temp[va1[0]] >= va1[1] && temp[va2[0]] <= va2[1]) {
                    clearInterval(W_T_balanceSearch);
                    T_cpt2(temp, 5);
                }
                console.info(TAG, va0[0] + '>=' + va0[1] + ', ' + va1[0] + '>=' + va1[1] + ', ' + va2[0] + '<=' + va2[1]);
            }, 200);
        }

        function T_TopSearch(arrayVal) {
            // clearInterval(W_TopSearchSwork);
            let debug = false;
            const TAG = 'log_T_TopSearch->';
            let temp = [];
            let cont = 0;
            let contc = 0;
            W_TopSearchSwork = setInterval(function () {
                cont = 0;
                temp = G_lsloop.concat();
                // temp = ls(LBsize79);
                console.info(TAG + contc++, temp);
                for (let i = 0; i < arrayVal.length; i++) {
                    if (temp[i] == arrayVal[i]) {
                        if (debug) console.log('temp[i]', temp[i]);
                        if (debug) console.log('arrayVal[i]', arrayVal[i]);
                        cont++;
                    }
                }
                if (cont == arrayVal.length) {
                    T_cpt2(temp, 5);
                    console.info(TAG + contc, temp);
                    clearInterval(W_TopSearchSwork);
                }
            }, 200)
        }

        function T_Searchfom(arrayVal) {
            // arrayVal 指定した値が含まれるまで探し
            // clearInterval(W_T_Searchfom);
            const TAG = 'T_Searchfom->';
            let tempArr = arrayVal.concat();
            W_T_Searchfom = setInterval(function () {
                let cont = 0;
                tempArr.forEach(function (e) {
                    if (G_lsloop.indexOf(e) >= 0) {
                        cont++;
                    }
                })
                // console.log(G_lsloop);
                console.info(TAG, ' clearInterval(W_T_Searchfom)  ' + arrayVal.toString());
                if (cont == arrayVal.length) {
                    clearInterval(W_T_Searchfom);
                    T_cpt2(G_lsloop);
                }
            }, 100)
            return G_lsloop;
        }

        function KeySearch() {
            let tabletag = document.getElementById('tb6');
            let pluskey = tabletag.getElementsByClassName('k+');
            let downkey = tabletag.getElementsByClassName('k-');
            let num = tabletag.getElementsByClassName('n');
            let logp = function () {
                console.info('log+', this.getAttribute('index'));
                num[this.getAttribute('index')].innerText = parseInt(num[this.getAttribute('index')].innerText) + 1;
                if (parseInt(num[this.getAttribute('index')].innerText) > LMax3743) {
                    num[this.getAttribute('index')].innerText = 1;
                }
                findnum();
            }
            let logd = function (e) {
                console.info('log-', this.getAttribute('index'));
                num[this.getAttribute('index')].innerText = parseInt(num[this.getAttribute('index')].innerText) - 1;
                if (parseInt(num[this.getAttribute('index')].innerText) < 0) {
                    num[this.getAttribute('index')].innerText = LMax3743;
                }
                findnum();
            }
            function findnum() {
                let temp = [];
                for (let i = 0; i < LBsize79; i++) {
                    temp.push(parseInt(num[i].innerText));
                }
                T_cpt2(temp);
            }
            for (let i = 0; i < pluskey.length; i++) {
                pluskey[i].addEventListener('click', logp, true);
                downkey[i].addEventListener('click', logd, true);
            }
        }

        function roolclock() {
            //
            let debug = false;
            const TAG = 'log_roolclock'
            if (debug) console.log(TAG, 'roolclock');
            let fadr = [];
            let rolldata = G_base_numsX;
            let tb = document.getElementById('tb1');
            let trs = tb.getElementsByTagName('tr');
            let iid = 0;

            let clock1 = function () {
                if (debug) console.log(TAG, 'clock1');
                fadr = [];
                if (isNaN(this.innerText)) {
                    for (let i = 0; i <= LMax3743; i++) {
                        fadr.push(i);
                    }
                    fns(fadr);
                    return;
                }
                G_fns = [];
                F_colorClear(2);
                this.nextElementSibling.style.backgroundColor = F_colorpool(2)[45];
                if (debug) console.log(TAG, this);
                fns(rolldata[this.innerText - 1], 1, 0, 1, rolldata.length - this.innerText + 6);
                // fns(rolldata[this.innerText], 0, 0, 1);
            }

            let dblclick1 = function () {
                if (debug) console.log(TAG, 'dblclick1');
                G_fnsa = [];
                fns(rolldata[this.innerText - 1], 0, 0, 1);
                // fns(rolldata[this.innerText], 1, 0, 1, rolldata.length - this.innerText + 6);
            }

            let clock2 = function () {
                if (debug) console.log(TAG, 'clock2');
                if (rolldata[this.previousElementSibling.innerText != '000']) {
                    T_addr(rolldata[this.previousElementSibling.innerText]);
                }
            }

            let clock3 = function () {
                let debug = false;
                const TAG = 'log_let clock3->';
                if (debug) console.log(TAG, 'clock3');
                let tpn = this.nextElementSibling;
                let index = 1;
                for (let i = 0; i < 9; i++) {
                    tpn = tpn.nextElementSibling;
                }
                switch (tpn.innerText) {
                    case 'nx1':
                        index = 1;
                        break;
                    case 'nx2':
                        index = 2;
                        break;
                    case 'nx3':
                        index = 3;
                        break;
                    case 'nx4':
                        index = 4;
                        break;
                    case 'nx5':
                        index = 5;
                        break;
                    default:
                }
                let arrayVal = G_lsloop.concat();
                if (debug) console.log(TAG, arrayVal);
                T_cpt2(arrayVal, index);
            }

            let clock4 = function () {
                // localStorage_additem event
                const TAG = 'log_let clock4 = function'
                if (debug) console.info(TAG, 'clock4');
                let tbrd = this.parentElement.getElementsByClassName('n');
                let temp = []
                if (this.nextElementSibling.nextElementSibling.nextElementSibling.innerText == '0') {
                    return;
                }
                for (let i = 0; i < tbrd.length; i++) {
                    temp.push(parseInt(tbrd[i].innerText));
                }
                localStorage_additem(temp);
            }

            let clock5 = function () {
                const TAG = 'log_let clock5 = function';
                if (debug) console.info(TAG, 'clock5');
                console.assert(G_fnsa.length != LBsize79);
                if (G_fnsa.length != LBsize79) {
                    return;
                }
                let temp = [];
                for (let i = 0; i < G_fnsa.length; i++) {
                    temp.push(G_fnsa[i]);
                }
                console.log(temp);
                localStorage_additem(G_fnsa);
            }
            document.getElementById('fnsw').addEventListener('click', clock5, true);

            for (let i = 0; i < trs.length; i++) {
                // 回別クリック
                if (trs[i].firstElementChild.innerText != '000') {
                    trs[i].firstElementChild.addEventListener('click', clock1, true);
                }
                // 回別Wクリック
                trs[i].firstElementChild.addEventListener('dblclick', dblclick1, true);
                // 抽選日Wクリック
                trs[i].firstElementChild.nextElementSibling.addEventListener('click', clock2, true);
                if (trs[i].firstElementChild.innerText == '000') {
                    // 回別000クリック
                    trs[i].firstElementChild.addEventListener('click', clock3, true);
                }
                if (trs[i].firstElementChild.nextElementSibling.innerText == '2020/1/1') {
                    // 抽選日クリック
                    trs[i].firstElementChild.nextElementSibling.addEventListener('click', clock4, true);
                }
            }
            num_click();

            //ボールキーを押されたとき、色ををつける
            //ボールクリックしたとき、番号のアルファベットをアレー作成
            let ballskey = [];
            let click6 = function () {
                if (ballskey.indexOf(this.innerText) == -1) {
                    ballskey.push(this.innerText);
                    // return;
                } else {
                    ballskey.splice(ballskey.indexOf(this.innerText), 1);
                    // return;
                }

                let ball = document.getElementsByClassName('bl');
                let colors = F_colorpool(2);
                for (let i = 0; i < ball.length; i++) {
                    ball[i].style.backgroundColor = '';
                    if (ballskey.indexOf(ball[i].innerText) != -1) {
                        ball[i].style.backgroundColor = colors[ball[i].innerText];
                    }
                }
            }

            let ball = document.getElementsByClassName('bl');
            for (let i = 0; i < ball.length; i++) {
                ball[i].addEventListener('click', click6, true);
            }
        }

        var G_fnsa = new Array();
        function num_click() {
            // 抽選番号のクリック
            let debug = false;
            const TAG = 'log_num_click()';
            let ns = document.getElementsByClassName('n');
            for (let i = 0; i < ns.length; i++) {
                ns[i].addEventListener('click', function () {
                    if (debug) console.log(TAG, 'Num click');
                    let intVal = parseInt(this.innerText);
                    if (intVal == 0) return;
                    if (G_fnsa.indexOf(intVal) == -1 && !isNaN(intVal)) {
                        G_fnsa.push(parseInt(this.innerText));
                    } else {
                        let v = G_fnsa.indexOf(parseInt(this.innerText));
                        G_fnsa.splice(v, 1);
                    }
                    fns(G_fnsa, 0, 0, 0);
                });
            }
        }

        function T_show_topNums() {
            // index の順番は数字の出番の順番になり。
            // index（順番), 0(抽選番号), 1(番号の出回数)
            let debug = false;
            const TAG = 'log_T_show_topNums->';
            let tb3 = document.getElementById('tb3');
            let tbrs = tb3.getElementsByClassName('n');
            let topNums = T_topNum(2);
            for (let i = 0; i < 21; i++) {
                tbrs[i].innerText = topNums[i][0];
            }
            topNums = T_topNum(1);
            console.info(TAG, TAGLine);
            console.info(TAG, 'index（順番), 0(抽選番号), 1(番号の出回数)');
            console.table(topNums);
            console.info(TAG, TAGLine);
            for (let i = 0; i < 21; i++) {
                tbrs[i + 21].innerText = topNums[i][0];
            }

            function G_m_f() {
                if (G_fnsa) {
                    G_num_filter = G_fnsa.concat();
                    this.firstElementChild.innerText = G_num_filter.sort((a, b) => a - b);
                    console.info(TAG, this.firstElementChild.innerText);
                }
            }
            document.getElementById('G_num_filter').addEventListener('click', G_m_f, true);
        }

        function T_show_top10Nums() {
            // index の順番は数字の出番の順番になり。
            // index（順番), 0(抽選番号), 1(番号の出回数)
            let debug = false;
            const TAG = 'log_T_show_top10Nums->';
            let tb4 = document.getElementById('tb4');
            let tbrs = tb4.getElementsByClassName('n');
            let topNums = T_topNum(2, 11);
            for (let i = 0; i < 21; i++) {
                tbrs[i].innerText = topNums[i][0];
            }
            topNums = T_topNum(1, 11);
            console.info(TAG, TAGLine);
            console.info(TAG, 'index（順番), 0(抽選番号), 1(番号の出回数)');
            console.table(topNums);
            console.info(TAG, TAGLine);
            for (let i = 0; i < 21; i++) {
                tbrs[i + 21].innerText = topNums[i][0];
            }
        }

        function T_show_topColor(arrayVal) {
            let debug = false;
            const TAG = 'log_T_show_topColor->';
            let colors = F_colorpool(2);

            // Color クリア
            let nums = document.getElementsByClassName('n');
            for (let i = 0; i < nums.length; i++) {
                nums[i].style.backgroundColor = '';
            }

            // Color 着ける
            nums = document.getElementsByClassName('n');
            for (let i = 0; i < nums.length; i++) {
                arrayVal.forEach(function (e) {
                    if (e == nums[i].innerText) {
                        nums[i].style.backgroundColor = colors[e];
                    }
                })
            }
        }

        function localStorage_tonx5() {
            //
            let debug = false;
            const TAG = 'log_localStorage_tonx5->';
            if (debug) console.log(TAG, this);
            let timeKey = this.previousElementSibling;
            for (let i = 0; i < 8; i++) {
                timeKey = timeKey.previousElementSibling;
            }
            if (debug) console.log(TAG, timeKey);
            let tempval = localStorage.getItem(timeKey.innerText).split(',');
            T_cpt2(tempval, 5);
        }

        function localStorage_tonx5_2() {
            //	SetItem(5) Wクリック
            let debug = false;
            const TAG = 'log_localStorage_tonx5->';
            if (debug) console.log(TAG, this);
            let timeKey = this.previousElementSibling;
            for (let i = 0; i < 8; i++) {
                timeKey = timeKey.previousElementSibling;
            }
            if (debug) console.log(TAG, timeKey);
            let tempval = localStorage.getItem(timeKey.innerText).split(',');
            fns(tempval, 2);
        }

        function localStorage_removeItem() {
            //
            let debug = false;
            const TAG = 'log_localStorage_removeItem->';
            if (debug) console.log(TAG, this);
            let timeKey = this.previousElementSibling;
            for (let i = 0; i < 0; i++) {
                timeKey = timeKey.previousElementSibling;
            }
            console.log(TAGLine);



            localStorage.removeItem(timeKey.innerText);
            this.parentElement.parentElement.removeChild(this.parentElement);
            F_selectNums();
        }

        function localStorage_pageload() {
            //
            let debug = false;
            const TAG = 'log_localStorage_pageload->';
            if (debug) console.log(TAG, 'step1');
            let req = new XMLHttpRequest();
            let url = '/' + CSVFile + '?key=' + Math.floor(Math.random() * (1 - 100) + 100);
            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    let tb2 = document.getElementById('tb2');
                    for (let i = 0; i < localStorage.length; i++) {
                        let tbclone = tb2.firstElementChild.cloneNode(true);
                        let timeKey = new Date(parseInt(localStorage.key(i)));
                        tbclone.firstElementChild.innerText = localStorage.key(i);
                        tbclone.firstElementChild.nextElementSibling.innerText = (timeKey.getFullYear() + '/' + (timeKey.getMonth() + 1) + '/' + timeKey.getDate());
                        let tempitem = tbclone.firstElementChild.nextElementSibling;
                        let temp = localStorage.getItem(localStorage.key(i)).split(',');
                        if (temp.length == LBsize79) {
                            for (let j = 0; j < temp.length; j++) {
                                tempitem = tempitem.nextElementSibling;
                                tempitem.innerText = temp[j];
                                tempitem.style.backgroundColor = F_colorpool(2)[temp[j]];
                            }
                            tempitem.nextElementSibling.nextElementSibling.innerText = fns2(temp.map(Number));
                            tempitem.nextElementSibling.addEventListener('click', localStorage_tonx5, true);
                            tempitem.nextElementSibling.addEventListener('dblclick', localStorage_tonx5_2, true);
                            tbclone.firstElementChild.nextElementSibling.addEventListener('click', localStorage_removeItem, true);
                            if (temp.length == LBsize79) {
                                tb2.appendChild(tbclone);
                            }
                        }
                    }
                    F_selectNums();
                } else {
                    return;
                }
            }
            req.open("GET", url, true);
            req.send(null);
        }

        function localStorage_additem(arrayVal) {
            // localStorage_additem
            let debug = false;
            const TAG = 'log_localStorage_additem->';
            if (debug) console.log(TAG, 'setp1');
            console.assert(arrayVal.length == LBsize79);
            let req = new XMLHttpRequest();
            let url = '/' + CSVFile + '?key=' + Math.floor(Math.random() * (1 - 100) + 100);
            req.onreadystatechange = function () {
                if (req.readyState == 4 && req.status == 200) {
                    if (debug) console.log(TAG, 'setp2');
                    localStorage_additem_add(arrayVal);
                    F_selectNums();
                } else {
                    return;
                }
            }
            req.open("GET", url, true);
            req.send(null);

            function localStorage_additem_add(arrayVal) {
                if (debug) console.info(TAG, 'step3');
                for (let i = 0; i < localStorage.length; i++) {
                    if (localStorage.getItem(localStorage.key(i)) == arrayVal.toString()) {
                        return;
                    }
                }
                let timeKey = new Date();
                if (debug) console.info(TAG, 'step4');
                localStorage.setItem(timeKey.getTime(), arrayVal.toString());
                let tb2 = document.getElementById('tb2');
                let tbclone = tb2.firstElementChild.cloneNode(true);
                tbclone.firstElementChild.innerText = timeKey.getTime();
                tbclone.firstElementChild.nextElementSibling.innerText = (timeKey.getFullYear() + '/' + (timeKey.getMonth() + 1) + '/' + timeKey.getDate());
                let tempitem = tbclone.firstElementChild.nextElementSibling;
                for (let j = 0; j < arrayVal.length; j++) {
                    if (arrayVal.length == LBsize79) {
                        tempitem = tempitem.nextElementSibling;
                        tempitem.innerText = arrayVal[j];
                        tempitem.style.backgroundColor = F_colorpool(2)[arrayVal[j]];
                    }
                }
                tempitem.nextElementSibling.nextElementSibling.innerText = fns2(arrayVal.map(Number));
                tempitem.nextElementSibling.addEventListener('click', localStorage_tonx5, true);
                tempitem.nextElementSibling.addEventListener('dblclick', localStorage_tonx5_2, true);
                tbclone.firstElementChild.nextElementSibling.addEventListener('click', localStorage_removeItem, true);
                tb2.appendChild(tbclone);
            }
        }

        function localStorage_master() {
            let debug = false;
            const TAG = 'log_localStorage_master->';
            G_LocalMaster = [];
            let master_temp = [];
            for (let i = 0; i < localStorage.length; i++) {
                let master_temp = [];
                localStorage.getItem(localStorage.key(i)).split(',').forEach(function (e) {
                    master_temp.push(parseInt(e));
                })
                if (master_temp.length == LBsize79) {
                    G_LocalMaster[G_LocalMaster.length] = master_temp;
                }
            }
            if (debug) console.log(TAG, G_LocalMaster);
            return G_LocalMaster;
        }

        function F_selectNums() {
            let debug = false;
            const TAG = 'log_F_selectNums->';
            let tx = localStorage_master();
            let temp2 = [];
            let temp = '';
            let iv = 0;
            tx.forEach(function (e) {
                for (let i = 0; i < LBsize79 - 1; i++) {
                    temp2.push(e[i]);
                }
            })
            temp2.sort((a, b) => a - b);
            for (let i = 0; i < temp2.length; i++) {
                if (temp2[i] == iv) {
                    temp = temp + ',' + temp2[i];
                } else {
                    iv = temp2[i];
                    temp = temp + '<br>' + temp2[i];
                }
            }
            if (debug) console.log(TAG, temp);
            document.getElementById('Selected').innerHTML = temp;
            document.getElementById('noselected').innerText = T_Excluded_number(temp2);
            G_L6ck4nums = T_Excluded_number(temp2);
        }

        function T_Excluded_number(arrayVal) {
            // T_Excluded_number() 予想番号を複数入力し,未使用番号を割り出す
            const TAG = 'log_T_Excluded_number->';
            let tempar = arrayVal.concat();
            let tt = [];
            for (let i = 1; i <= LMax3743; i++) {
                tt.push(i);
            }
            let temp = tt.filter(function (ia) {
                if (tempar.indexOf(ia) == -1) {
                    return ia;
                }
            })
            console.info(TAG, 'fns([' + temp + '])  未選択番号');
            return temp;
        }

        function help() {
            console.info('G_addr:', '選択番号複数');
            console.info('G_fnsa:', '選択番号1個追加');
            console.info('G_lsloop:', 'ランダム番号連続発生');
            console.info('G_LocalMaster:', '選択した番号マスター');
            console.info('G_num_filter:', '除外番号フィルタ');
            console.info('G_base_numsX:', '抽選番号マスター,X軸');
            console.info('G_base_numsY:', '抽選番号マスター,Y軸, T_baseReport(G_base_numsY),T_baseReport(G_base_numsY,1530,10)');
            console.info('fns():', 'htmlと参照');
            console.info('fns2():', 'G_base_numsXと参照');
            console.info('T_nextLoto(arrayVal):', 'T_nextLoto(G_base_numsY[0])');
            console.info('T_nextLoto2(arrayVal, intVal):', 'T_nextLoto(G_base_numsY[0],1)');
            console.info('T_ncont2()', '出番と購入の比較');
            console.info('T_TopSearch()', '指定番号まで確認');
            console.info('T_Searchfom()', '指定番号含まれるまで確認');
            console.info('T_balanceSearch()', '指定番号以下,指定位置番号探し');
            console.info('T_baseReport()', '抽選番号レポート T_baseReport(new T_toYaxis(G_LocalMaster).value, 1, 1)');
            console.info('T_NUMunionReport(intVal, intVal2)', '番号,位置');
            console.info('T_NumFix(intVal, indexInt)', '番号,位置,番号固定');
            console.info('T_BallMask(charArray)', 'ボールの結果を除外');
            console.info('T_NumMask(intVal, indexInt)', '番号,位置,番号のみHTML表示');
            console.info('T_GetnextNums(,):', '1個番号とよく出る次の列の番号アレーを割り出す T_GetnextNums(1,1)');
            console.info('T_addr():', '[]番号を追加,番号の出番を確認');
            console.info('T_ck():', '予想番号を生成,htmlと参照');
            console.info('T_ck2():', '予想番号を生成,masterと参照');
            console.info('T_ck3():', '設定番号除外して予想番号を生成');
            console.info('T_cpt2():', '先頭に予想番号を追加');
            console.info('T_L6ck4()', '重複しない番号を作成');
            console.info('T_Excluded_number():', '予想番号を複数入力し,未使用番号を割り出す');
            console.info('T_ncont():', 'すべての出番数字の合計');
        }

        window.addEventListener('beforeunload', function () {
            const TAG = 'log_window.addEventListener->';
            // console.log('beforeunload');
            // return '本当に離れますか？';
            console.log(TAG, this);
            event.preventDefault();
            event.returnValue = '';
        });

        window.addEventListener('load', function () {
            let debug = false;
            const TAG = 'log_window.addEventListener->';
            if (debug) console.log(TAG, 'window.onload');
            document.title = PGtitle;
            F_hit_table();
            setTimeout(function () {
                console.log(TAG, 'roolclock');
                localStorage_pageload();
                roolclock();
                F_lsloop();
                T_show_topNums();
                T_show_top10Nums();
                F_selectNums();
                KeySearch();
                T_baseReport(G_base_numsY, G_base_numsY[0].length, 10);
            }, 3000);
            help();
        });

        window.addEventListener('DOMContentLoaded', function () {
            console.log('window.DOMContentLoaded');
        });

        document.addEventListener('DOMContentLoaded', function () {
            console.log('document.DOMContentLoaded');
        });

    </script>
    <Button id="hide">style</Button>
    <div id="heid">
        <div id="x6"></div>
        <p id="p1"></p>
        <p id="p2"></p>
        <p id="txd"></p>
        <div>Select Number</div>
        <div id="Selected">Select Number</div>
        <br>
        <div>noselected</div>
        <div id="noselected">noselected</div>
        <br>
        <div id="G_num_filter">G_num_filter=[]
            <div>xx,xx,xx,xx,xx,xx,xx</div>
        </div>
        <br>
        <div class="tableaera">
            <table table border="1" cellspacing="0" cellpadding="1" bordercolor="#333333" style="display:''">
                <tbody id="tb2">
                    <tr align="right">
                        <td style="display:none">getItem</td>
                        <td>DEL date</td>
                        <td class="n">(x1)</td>
                        <td class="n">(x2)</td>
                        <td class="n">(x3)</td>
                        <td class="n">(x4)</td>
                        <td class="n">(x5)</td>
                        <td class="n">(x6)</td>
                        <td class="n">(x7)</td>
                        <td>SetItem(5)</td>
                        <td>レ7</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <table table border="1" cellspacing="0" cellpadding="1" bordercolor="#333333" style="display:''">
            <tbody id="tb3">
                <tr>
                    <td class="table">Tops</td>
                    <td>(x1)</td>
                    <td>(x2)</td>
                    <td>(x3)</td>
                    <td>(x4)</td>
                    <td>(x5)</td>
                    <td>(x6)</td>
                    <td>(x7)</td>
                    <td>(x8)</td>
                    <td>(x9)</td>
                    <td>(xA)</td>
                    <td>(xB)</td>
                    <td>(xC)</td>
                    <td>(xD)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                </tr>
                <tr>
                    <td class="table">top</td>
                    <td class="n">(x1)</td>
                    <td class="n">(x2)</td>
                    <td class="n">(x3)</td>
                    <td class="n">(x4)</td>
                    <td class="n">(x5)</td>
                    <td class="n">(x6)</td>
                    <td class="n">(x7)</td>
                    <td class="n">(x8)</td>
                    <td class="n">(x9)</td>
                    <td class="n">(xA)</td>
                    <td class="n">(xB)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                </tr>
                <tr>
                    <td class="table">down</td>
                    <td class="n">(x1)</td>
                    <td class="n">(x2)</td>
                    <td class="n">(x3)</td>
                    <td class="n">(x4)</td>
                    <td class="n">(x5)</td>
                    <td class="n">(x6)</td>
                    <td class="n">(x7)</td>
                    <td class="n">(x8)</td>
                    <td class="n">(x9)</td>
                    <td class="n">(xA)</td>
                    <td class="n">(xB)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table table border="1" cellspacing="0" cellpadding="1" bordercolor="#333333" style="display:''">
            <tbody id="tb4">
                <tr>
                    <td class="table">Tops</td>
                    <td>(x1)</td>
                    <td>(x2)</td>
                    <td>(x3)</td>
                    <td>(x4)</td>
                    <td>(x5)</td>
                    <td>(x6)</td>
                    <td>(x7)</td>
                    <td>(x8)</td>
                    <td>(x9)</td>
                    <td>(xA)</td>
                    <td>(xB)</td>
                    <td>(xC)</td>
                    <td>(xD)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                    <td>(xE)</td>
                </tr>
                <tr>
                    <td class="table">top</td>
                    <td class="n">(x1)</td>
                    <td class="n">(x2)</td>
                    <td class="n">(x3)</td>
                    <td class="n">(x4)</td>
                    <td class="n">(x5)</td>
                    <td class="n">(x6)</td>
                    <td class="n">(x7)</td>
                    <td class="n">(x8)</td>
                    <td class="n">(x9)</td>
                    <td class="n">(xA)</td>
                    <td class="n">(xB)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                </tr>
                <tr>
                    <td class="table">down</td>
                    <td class="n">(x1)</td>
                    <td class="n">(x2)</td>
                    <td class="n">(x3)</td>
                    <td class="n">(x4)</td>
                    <td class="n">(x5)</td>
                    <td class="n">(x6)</td>
                    <td class="n">(x7)</td>
                    <td class="n">(x8)</td>
                    <td class="n">(x9)</td>
                    <td class="n">(xA)</td>
                    <td class="n">(xB)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xD)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                    <td class="n">(xE)</td>
                </tr>
            </tbody>
        </table>
        <p> </p>
        <button id="fnsw">AddFns([])</button>

        <table table border="1" cellspacing="0" cellpadding="1" bordercolor="#333333" style="display:''">
            <tbody id="tb5">
                <tr>
                    <td width="34" class="n">1</td>
                    <td width="34" class="n">2</td>
                    <td width="34" class="n">3</td>
                    <td width="34" class="n">4</td>
                    <td width="34" class="n">5</td>
                    <td width="34" class="n">6</td>
                    <td width="34" class="n">7</td>
                    <td width="34" class="n">8</td>
                    <td width="34" class="n">9</td>
                    <td width="34" class="n">10</td>
                    <td width="34" class="n">11</td>
                    <td width="34" class="n">12</td>
                    <td width="34" class="n">13</td>
                    <td width="34" class="n">14</td>
                    <td width="34" class="n">15</td>
                    <td width="34" class="n">16</td>
                    <td width="34" class="n">17</td>
                    <td width="34" class="n">18</td>
                    <td width="34" class="n">19</td>
                    <td width="34" class="n">20</td>
                </tr>
                <tr>
                    <td class="n">21</td>
                    <td class="n">22</td>
                    <td class="n">23</td>
                    <td class="n">24</td>
                    <td class="n">25</td>
                    <td class="n">26</td>
                    <td class="n">27</td>
                    <td class="n">28</td>
                    <td class="n">29</td>
                    <td class="n">30</td>
                    <td class="n">31</td>
                    <td class="n">32</td>
                    <td class="n">33</td>
                    <td class="n">34</td>
                    <td class="n">35</td>
                    <td class="n">36</td>
                    <td class="n">37</td>
                    <td class="n">38</td>
                    <td class="n">39</td>
                    <td class="n">40</td>
                </tr>
                <tr>
                    <td class="n">41</td>
                    <td class="n">42</td>
                    <td class="n">43</td>
                </tr>
            </tbody>
        </table>
        <P> </P>
        //////////////////// Works ////////////////
        <div class="tableaera">
            <table table border="1" cellspacing="0" cellpadding="1" bordercolor="#333333" style="display:''">
                <tbody id="tb6">
                    <tr align="right">
                        <td>回別</td>
                        <td>抽選日</td>
                        <td>(x1)</td>
                        <td>(x2)</td>
                        <td>(x3)</td>
                        <td>(x4)</td>
                        <td>(x5)</td>
                        <td>(x6)</td>
                        <td>ボナ</td>
                        <td>口数</td>
                        <td>選金</td>
                        <td>オバ</td>
                        <td>BL</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr align="right">
                        <td>000</td>
                        <td class="d">2021/1/19</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td>0</td>
                        <td>nx6</td>
                        <td>0</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr align="right">
                        <td>000</td>
                        <td class="d">2021/1/19</td>
                        <td class="k+" index="0">+</td>
                        <td class="k+" index="1">+</td>
                        <td class="k+" index="2">+</td>
                        <td class="k+" index="3">+</td>
                        <td class="k+" index="4">+</td>
                        <td class="k+" index="5">+</td>
                        <td class="k+" index="6">+</td>
                        <td>0</td>
                        <td>nx6</td>
                        <td>0</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr align="right">
                        <td>000</td>
                        <td class="d">2021/1/19</td>
                        <td class="k-" index="0">-</td>
                        <td class="k-" index="1">-</td>
                        <td class="k-" index="2">-</td>
                        <td class="k-" index="3">-</td>
                        <td class="k-" index="4">-</td>
                        <td class="k-" index="5">-</td>
                        <td class="k-" index="6">-</td>
                        <td>-</td>
                        <td>nx6</td>
                        <td>-</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                </tbody>
            </table>
        </div>
        //////////////////// Works ////////////////
        <P> </P>
        <div class="tableaera">
            <table table border="1" cellspacing="0" cellpadding="1" bordercolor="#333333" style="display:''">
                <tbody id="tb1">
                    <tr align="right">
                        <td>回別</td>
                        <td class="d">抽選日</td>
                        <td class="n">(x1)</td>
                        <td class="n">(x2)</td>
                        <td class="n">(x3)</td>
                        <td class="n">(x4)</td>
                        <td class="n">(x5)</td>
                        <td class="n">(x6)</td>
                        <td class="n">ボナ</td>
                        <td>口数</td>
                        <td>選金</td>
                        <td>オバ</td>
                        <td>BL</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr id=nx1 align="right">
                        <td>000</td>
                        <td class="d">2020/1/1</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td>0</td>
                        <td>nx1</td>
                        <td>0</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr id=nx2 align="right">
                        <td>000</td>
                        <td class="d">2020/1/1</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td>0</td>
                        <td>nx2</td>
                        <td>0</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr id=nx3 align="right">
                        <td>000</td>
                        <td class="d">2020/1/1</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td>0</td>
                        <td>nx3</td>
                        <td>0</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr id=nx4 align="right">
                        <td>000</td>
                        <td class="d">2020/1/1</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td>0</td>
                        <td>nx4</td>
                        <td>0</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr id=nx5 align="right">
                        <td>000</td>
                        <td class="d">2020/1/1</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td class="n">0</td>
                        <td>0</td>
                        <td>nx5</td>
                        <td>0</td>
                        <td class="bl">X</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                    <tr align="right">
                        <td>回別</td>
                        <td class="d">抽選日</td>
                        <td class="n setColor">(x1)</td>
                        <td class="n setColor">(x2)</td>
                        <td class="n setColor">(x3)</td>
                        <td class="n setColor">(x4)</td>
                        <td class="n setColor">(x5)</td>
                        <td class="n setColor">(x6)</td>
                        <td class="n setColor">ボナ</td>
                        <td>口数</td>
                        <td>選金</td>
                        <td>オバ</td>
                        <td class="bl">BL</td>
                        <td>レ7</td>
                        <td>レ6</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
    <p> </p>
</body>

</html>