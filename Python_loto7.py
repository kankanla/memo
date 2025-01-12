# pip install numpy
# pip install pandas
# pip install pyplot
# pip install matplotlib
# pip list
# pip show selenium

import csv
import os
import sys


def t2k(tag):
    import sqlite3

    con = sqlite3.connect("alll7.db")
    sqlcmd = """select s1,s2,s3,s4,s5,s6,s7 from loto7 """
    cas = [0 for i in range(39)]
    cr = con.execute(sqlcmd)
    for da in cr:
        if tag[0] in da:
            for x in da:
                cas[x] = cas[x] + 1
        pass

    # print(cas)
    # print(tag[1])
    # print(cas[tag[1]])
    con.close()
    if cas[tag[1]] < 13:
        return cas[tag[1]]
    else:
        return cas[tag[1]]


# print (t2k([37, 13]))
# print (t2k([37, 21]))
# print (t2k([37, 2]))
# t2k([1, 37])


def t7t2k(tag, v):
    x = len(tag)
    y = len(tag)
    f = 1
    fc8 = 0  # 8より小さいの組合せ
    fc8c = 2  # 8より小さいの組合せ2個より多い場合,廃棄
    fc16 = 0  # 16より小さいの組合せ
    fc16c = 27  # 16より小さいの組合せ27個より多い場合,場合廃棄
    vw = []
    for i in range(x):
        for j in range(y):
            if v == 1:
                print(tag[i], tag[j])
                print(t2k([tag[i], tag[j]]))
                vw.append(t2k([tag[i], tag[j]]))
            if v == 2:
                vw.append(t2k([tag[i], tag[j]]))
            temp = t2k([tag[i], tag[j]])
            if temp < 8:
                fc8 = fc8 + 1
            if fc8 == fc8c:
                f = 0
            if temp < 16:
                fc16 = fc16 + 1
            if fc16 > fc16c:
                f = 0
    if v == 1:
        vw.sort()
        print(tag, vw)
    if v == 2:
        vw.sort()
        return vw
    return f


# print(t7t2k([2,16,17,24,25,35,36],1))   ## return 0
# print(t7t2k([9,14,22,26,27,33,37],1))   ## return 1


def t7t2klist():
    fw = open("xList2-l7.csv", "w", newline="")
    fr = open("loto7c.csv", "r")
    cr = csv.reader(fr)

    for cc in cr:
        cw = csv.writer(fw, delimiter="\t")
        tl = []
        tl.append(cc)
        temp = t7t2k(
            [
                int(cc[2]),
                int(cc[3]),
                int(cc[4]),
                int(cc[5]),
                int(cc[6]),
                int(cc[7]),
                int(cc[8]),
            ],
            2,
        )
        for i in temp:
            tl.append(i)
        cw.writerow(tl)
        # break
    fw.close()
    fr.close()


# t7t2klist()


def t7t2kone(cc):
    # print(cc)
    temp = t7t2k(
        [
            int(cc[0]),
            int(cc[1]),
            int(cc[2]),
            int(cc[3]),
            int(cc[4]),
            int(cc[5]),
            int(cc[6]),
        ],
        2,
    )
    print(temp)


# t7t2one([0,0,1,2,3,4,5,6,7])


def bas2(tag, l=9):
    import sqlite3

    con = sqlite3.connect("alll7.db")
    sqlcmd = "select * from loto7"
    cas = [i for i in range(1, 38)]
    cr = con.execute(sqlcmd)
    llist = []
    print("////////////////////////////////////////")
    print("///////////////           //////////////")
    print("////////////////////////////////////////")
    for val in cr:
        temp = list(val[2:l])
        flg = 0
        for k in tag:
            if k not in temp:
                flg = 1
        if flg == 0:
            print(val)
            # print(str(val[0])+'  '+str(val[1]), temp)
            for k in temp:
                llist.append(k)
            # llist.append(temp)
    print("////////////////////////////////////////")
    print("all", llist)
    for k in cas:
        if llist.count(k) >= 5:
            print(k, str(llist.count(k)) + "  ++")
        elif llist.count(k) == 0:
            print(k, str(llist.count(k)) + "  --")
        else:
            print(k, str(llist.count(k)) + "    ")


# bas2([7,11])


# def t1():
# url1 = 'https://raw.githubusercontent.com/kankanla/memo/master/loto7.csv'
# url2 = 'https://raw.githubusercontent.com/kankanla/memo/master/loto7c.csv'
# # lpd = pd.read_csv(url1, header=None)
# # lpd = pd.read_csv(url1,names=('t1','d1','s1','s2','s3','s4','s5','s6','s7','b1','b2','n1','n2','n3','z1','z2'))
# # lpd = pd.read_csv(url1,names=('t1','d1','s1','s2','s3','s4','s5','s6','s7','b1','b2','n1','n2','n3','z1','z2'))
# lpd = pd.read_csv(url1, names=('t1', 'd1', 's1', 's2', 's3', 's4', 's5', 's6', 's7',
#                   'b1', 'b2', 'n1', 'n2', 'n3', 'z1', 'z2'), usecols=[1, 2, 3, 4, 5, 6, 7, 8, ])
# # lpd = pd.read_csv(url1, header=None, usecols=[1, 2, 3, 4, 5, 6, 7, 8, ])

# lpd.set_index('d1')
# lpd.index
# lpd.plot()
# # lpd.plot('d1', ['s1', 's2', 's3', 's4', 's5', 's6', 's7'])
# plt.show()
# print('77')


def tx1(num):
    # xStep-L7.csv ファイルから出番の間隔確認
    import csv

    f = open("xStep-L7.csv", "r")
    da = csv.reader(f)
    for x in da:
        if int(num) > int(x[0]) and int(num) < int(x[1]):
            if int(x[2]) > 1:
                return 2
            return 1
    return 0


# tx1(8149925)


def t6():
    print(t6.__name__)
    # 番号指定 Loto7
    # 出る番号と除外番号を指定し，ランダムに番号を出す
    import sqlite3

    con = sqlite3.connect("alll7.db")
    # sqlcmd = '''select * from alll7 where id=abs(random())%10295473'''
    sqlcmd = """select * from alll7 where id=abs(random())%10280000"""

    # sqlcmd = '''select * from alll7 where id=abs(random())%10295473 and id >1458200 and id < 8041128 '''
    # loto7.loc[:,12].describe()
    # mean	5365861e+06
    # std	3031056e+06
    # min	1458200e+04
    # 25%	2820762e+06
    # 50%	5539011e+06
    # 75%	8041128e+06
    # max	1027423e+07

    # sqlcmd = '''select * from alll7 where id=abs(random())%10295473 and id >2940107 and id < 9016912 '''
    # loto7.loc[0:20,[12]].describe()
    # mean	4965708e+06
    # std	5729267e+06
    # min	9145050e+05
    # 25%	2940107e+06
    # 50%	4965708e+06
    # 75%	6991310e+06
    # max	9016912e+06

    # 番号指定 Loto7
    # tag = [[回数],[予想番号],[除外番号]]
    # tag = [[458],[5, 9, 15, '17+', 31, '33+', 36],[3, 4, 6, '11+', '12+', 16, 20, 23]]
    tag2 = [
        [459],  # 回数
        [12, 15, 9, 26, 33, 30, 35, 34, 11, 13, 21, 27, 23, 31, 36],  # 存在リスト
        [33, 20, 18, 29, 6, 1, 32, 28],  # 非存在リスト
        [3],  # 存在回数
        [3],  # 非存在回数
    ]

    # tag = [[459], [2+,5,6,7+,8+,9,10+,11,12,13,14,15,17,18,21,22,23,24,26,27,31,33,34,36], [1,3,4+,16,19,20+,25,28,29+,30,32,35,37], [3], [3]]
    # tag = [[460], [1, 2, 3, 4+, 5*, 6*, 7, 9*, 10, 11, 12, 14, 15, 17, 19, 20, 21, 23*, 24, 26, 27*, 28*, 30*, 31, 32, 33, 34, 35, 36, 37], [8, 13+, 16, 18, 22, 25, 29], [3], [1]]
    tag = [[463], [5, 6, 27], [0], [2], [0]]

    tagx = [[459], list(range(1, 38)), list(range(38, 48)), [0], [0]]

    ccont = 100  # 結果の回数
    x = 1
    pool = [i for i in range(1, 38)]
    while True:
        cur = con.execute(sqlcmd)
        for xx in cur:
            nocnt = 0  # 除外カウンタ
            incnt = 0  # 存在カウンタ
            for j in tag[2]:
                if j in xx:
                    nocnt = nocnt + 1

            if nocnt == tag[4][0]:
                for j in tag[1]:
                    if j in xx:
                        incnt = incnt + 1
                if incnt > tag[3][0]:
                    tck = tx1(xx[0])  # 間隔確認
                    if tck == 0 or tck > 1:
                        # print(xx)
                        # print(xx[1:8])
                        # print (t7t2k(list(xx[1:8])))
                        if t7t2k(list(xx[1:8]), 0) == 1:  # 組合せよく出る番号の組合せ
                            if ccont < 11:
                                print(
                                    "localStorage_additem([{},{},{},{},{},{},{},{},{}])".format(
                                        xx[1],
                                        xx[2],
                                        xx[3],
                                        xx[4],
                                        xx[5],
                                        xx[6],
                                        xx[7],
                                        tck,
                                        xx[0],
                                    )
                                )
                            f = open("xList2-l7temp.txt", "a")
                            f.write(
                                "localStorage_additem([{},{},{},{},{},{},{},{},{}])\n".format(
                                    xx[1],
                                    xx[2],
                                    xx[3],
                                    xx[4],
                                    xx[5],
                                    xx[6],
                                    xx[7],
                                    tck,
                                    xx[0],
                                )
                            )
                            f.close()
                            x = x + 1
                            print(x, end="\r")
                            ttx = list(xx[1:8])
                            break
        if x > ccont:
            con.close()
            f.close()
            # sys.stdout.write('end')
            break
    print(t6.__name__)


# 三つの組み合わせてOはないかを確認する．
def nfcck(nums, pg=0):
    print(nfcck.__name__)
    import itertools
    import sqlite3

    flag = 0
    combos = list(itertools.combinations(nums, 3))
    dbname = "alll7.db"
    con = sqlite3.connect(dbname)
    cursor = con.cursor()
    sql = "select * from fcck37 where s1=%d and s2=%d and s3=%d"
    for cs in combos:
        cursor.execute(sql % (cs[0], cs[1], cs[2]))
        re = cursor.fetchone()
        if re[4] <= 1:
            if pg == 0:
                pass
                print(re, "----", str(re[4]))
            if re[4] == 0:
                flag += 1
        else:
            if pg == 0:
                pass
                print(re)
    print("fcck max = 10  min = 0")
    return flag
    print(nfcck.__name__)


# 2つの組み合わせてOはないかを確認する．
def nfcck2(nums, pg=0):
    print(nfcck2.__name__)
    import itertools
    import sqlite3

    flag = 0
    combos = list(itertools.combinations(nums, 2))
    dbname = "alll7.db"
    con = sqlite3.connect(dbname)
    cursor = con.cursor()
    sql = "select * from fcck372 where s1=%d and s2=%d"
    for cs in combos:
        cursor.execute(sql % (cs[0], cs[1]))
        re = cursor.fetchone()
        if re[3] <= 11:
            if pg == 0:
                pass
                print(re, "----", str(re[3]))
            if re[3] < 11:
                flag += 1
        else:
            if pg == 0:
                pass
                print(re)
    print("fcck max = 32  min = 7")
    return flag
    print(nfcck2.__name__)


def t7():
    print(t7.__name__)
    print("////////////////////////////////////////////")
    print("////////////////////////////////////////////")
    print("////////////////////////////////////////////")
    import random
    import sqlite3

    con = sqlite3.connect("alll7.db")
    # sqlcmd = '''select * from alll7 where id=abs(random())%10295473'''
    # sqlcmd = '''select * from alll7 where id=abs(random())%10280000'''
    # sqlcmd = "select * from alll7 where fcck4 > 20 and fcck5 > 1 and id="
    sqlcmd = "select * from alll7 where fcck4 > 5 and fcck4 < 12 and fcck5 > 0 and id="
    # sqlcmd = "select * from alll7 where id="
    pool = list(range(1, 38))

    epool = [
        # [14, 17, 18, 26, 27, 32, 34],
        # [1, 7, 10, 11, 15, 22, 31],
        # [3, 9, 16, 23, 25, 36, 37],
        # [5, 8, 12, 19, 21, 24, 30],
        # [3,7,11,17,29,31,37],
        # [1,7,9,14,25,31,34]
    ]

    tag = [
        [2, 4, 0, 0, 0, 0, 0],
        [3, 7, 0, 0, 0, 0, 0],
        [7, 8, 0, 0, 0, 0, 0],
        [7, 11, 0, 0, 0, 0, 0],
    ]

    for val in epool:
        for v in val:
            if v in pool:
                pool.remove(v)
    xc = 0
    sqlcnt = 0
    keep = 40000
    while True:
        keep = keep - 1
        cur = con.execute(sqlcmd + str(random.randint(1, 10280000)))
        sqlcnt = sqlcnt + 1
        for val in cur:
            tf = True
            temp = val[1:8]
            print("                                                       ", end="\r")
            print(sqlcnt, val, end="\r")
            if keep > 0:
                sqlcnt = sqlcnt - 1
                break
            keep = 100
            # 7 8 11 13 14 26 30
            # 5, 6, 7, 8, 32, 33, 34, 36
            # すべての数字が含むか
            # if (temp[0] != 5 or temp[1] != 6 or temp[2] != 7 or temp[3] != 8 or temp[4] != 32 or temp[5] != 34 or temp[6] != 36):
            #     break
            # else:
            #     print('sqlcnt', sqlcnt)

            # # 先頭数字が含むか
            # if temp[0] != 6 or temp[1] != 7 or temp[2] != 10:
            #     break

            # Array Not in array
            # if 8 not in temp or 15 not in temp or 24 not in temp and 35 not in temp:
            #     # fcck4 > 5 and fcck5 >0
            #     break

            # 数字が含むか
            # if  9 not in temp or 15 not in temp or 26 not in temp or 34 not in temp:
            # if  10 not in temp or 27 not in temp or 32 not in temp or 33 not in temp:
            # if  15 not in temp or 26 not in temp or 34 not in temp or 36 not in temp:
            # if  17 not in temp or 22 not in temp or 26 not in temp:
            # 2023-04-10 01:49:55 [10,17,22,26]
            # if 10 not in temp or 17 not in temp or 22 not in temp or 26 not in temp:
            # 2023-04-17 06:21:33 [7,15,31]
            # if 7 not in temp or 15 not in temp or 31 not in temp:
            # 2023-04-19 01:29:00 [7,8,13,15,24,26,30,32] -24
            # 2023-05-04 10:16:36 [4, 5, 6, 8, 11, 17, 27, 31, 35, 37, 41, 42]

            # sqlite> select * from fcck37 where fcck > 7;
            # | 2567 | 5  | 15 | 25 | 8    |
            # | 3473 | 7  | 15 | 31 | 8    |
            # | 3467 | 7  | 15 | 25 | 9    |
            # | 3310 | 7  | 9  | 15 | 8    |
            # | 4031 | 8  | 24 | 30 | 8    |

            if 34 not in temp:
                break

            # if (7 not in temp) or (15 not in temp) or (31 not in temp):
            #     print("e2  ")
            #     # break

            nfcckck = nfcck(
                [temp[0], temp[1], temp[2], temp[3], temp[4], temp[5], temp[6]], 1
            )
            print(nfcckck)
            if nfcckck > 4:
                print("--nfcckck--" + str(nfcckck) + "--nfcckck--")
                print("---- 2023-04-02 08:14:47 ----")
                break

            nfcckck2 = nfcck2(
                [temp[0], temp[1], temp[2], temp[3], temp[4], temp[5], temp[6]], 1
            )
            print(nfcckck2)
            if nfcckck2 > 1:
                print("--nfcckck2--" + str(nfcckck2) + "--nfcckck2--")
                print("---- 2023-04-03 01:33:42 ----")
                break

            if t7t2k(list(val[1:8]), 0) == 1:
                for v in temp:
                    if v not in pool:
                        tf = False
                        break

                if tf == True:
                    for vx in temp:
                        pool.remove(vx)

                    tck = tx1(val[0])
                    print(
                        "localStorage_additem([{},{},{},{},{},{},{},{},{}])".format(
                            val[1],
                            val[2],
                            val[3],
                            val[4],
                            val[5],
                            val[6],
                            val[7],
                            tck + 90,
                            val[0],
                        )
                    )
                    f = open("xList2-l7temp.txt", "a")
                    f.write(
                        "localStorage_additem([{},{},{},{},{},{},{},{},{}])\n".format(
                            val[1],
                            val[2],
                            val[3],
                            val[4],
                            val[5],
                            val[6],
                            val[7],
                            tck + 90,
                            val[0],
                        )
                    )
                    f.close()
                    tl = []
                    tl.append(val)
                    ttx = list(val[1:8])
                    ttxtag = [7, 8, 13, 17, 30, 32, 36]
                    if ttx == ttxtag:
                        print("////////////////////////////////////////////////////")
                        print(ttx, ttxtag)
                        print(list(val[1:8]))
                        print("////////////////////////////////////////////////////")
                        break

                    temp = t7t2k(
                        [
                            int(val[1]),
                            int(val[2]),
                            int(val[3]),
                            int(val[4]),
                            int(val[5]),
                            int(val[6]),
                            int(val[7]),
                        ],
                        2,
                    )
                    for i in temp:
                        tl.append(i)
                    fw = open("xList2-l7temp.txt", "a", newline="")
                    # fw = open('xList2-l7.csv', 'a', newline='')   del
                    cw = csv.writer(fw, delimiter="\t")
                    cw.writerow(tl)
                    fw.close()
                    sqlcnt = 0
                    xc = xc + 1
                    print("///", pool)

                if sqlcnt > 300:
                    pool = list(range(1, 38))
                    for val in epool:
                        for v in val:
                            if v in pool:
                                pool.remove(v)
                    sqlcnt = 0
                    print("//4//", pool)
                    print("///////////////////////////////////333////////")
                    print("                                                ", end="\r")

                    f = open("xList2-l7temp.txt", "a")
                    f.write("//------\n")
                    f.close()

                    fw = open("xList2-l7temp.txt", "a", newline="")
                    # fw = open('xList2-l7.csv', 'a', newline='')    del
                    cw = csv.writer(fw, delimiter="\t")
                    cw.writerow([])
                    fw.close()

        if xc == 100:
            print(pool)
            break
        if sqlcnt == 100000000000:
            print("///1Gend", pool)
            sqlcnt = 0
            con.close()
            break
    con.close()
    print(t7.__name__)


# t7()
# takadababa66o2

# t6()
# bas2([3,21])  # 9 or 11
# bas2([8,17],9)  # 9 or 11 ()
# 7,11,15,22,26,?,35
# localStorage_additem([7,11,24,28,31,36,37,90,8028009])
# localStorage_additem([7,11,24,30,31,32,36,90,8028089])
# localStorage_additem([7,11,24,28,31,33,37,90,8028003])
# localStorage_additem([7,11,24,30,32,36,37,90,8028110])
# localStorage_additem([7,8,13,15,26,30,32,90,7734642])  #2023-04-19 01:44:18
# localStorage_additem([8,13,15,24,26,30,32,0,8572856])  #2023-04-19 01:44:18
# t7t2klist()
# print(t2k([35, 36]))
# print(t7t2k([3,7,10,16,18,19,32,35,37], 1))
# print(t7t2k([3,14, 16, 17, 23, 25, 36], 1))
# 2,3,13,16,20,25,27,30,37
# 000	2020/1/1	6	11	19	22	24	31	35	0	7425431	0	nx5	0	A	22	22	ll7
# fns([4,7,10,21,28,34,36])
# localStorage_additem([12,15,21,25,26,31,0,0,0])
# localStorage_additem([3,4,16,20,23,28,30,32,0])


def ta():
    print(ta.__name__)
    # 組み合わせ確認
    import csv
    import sqlite3

    f = open("xList-L7.csv", "w", newline="")
    con = sqlite3.connect("alll7.db")
    sqlcmd = """select s1,s2,s3,s4,s5,s6,s7 from loto7 """
    aln = list(range(1, 38))
    print(aln)
    print("")

    cw = csv.writer(f, delimiter="\t")
    for tag in aln:
        cr = con.execute(sqlcmd)
        cas6 = [0 for i in range(45)]
        cas7 = [0 for i in range(38)]
        cas7 = [0] * 38
        for jj in cr:
            if tag in jj:
                for x in jj:
                    if x >= tag:
                        cas7[x] = cas7[x] + 1
        print(tag, cas7)
        cw.writerow(cas7)
    con.close()
    f.close()
    print(ta.__name__)


# ta()


# 2023-04-24
# localStorage_additem([7,11,24,28,31,36,37,0,8028009]) 8028009 0
# localStorage_additem([6,11,24,28,31,36,37,0,0])   7434234 2

# localStorage_additem([7,11,24,30,31,32,36,0,8028089]) 8028089 0
# localStorage_additem([3,17,24,30,31,32,36,0,0])   4875743 3

# localStorage_additem([7,11,24,28,31,33,37,0,8028003]) 8028003 2
# localStorage_additem([7,11,24,30,32,36,37,0,8028110]) 8028110 2


# 2023-02-25 10:29:31
# localStorage_additem([6,21,24,28,31,36,37,0,0])   7656456 2
# localStorage_additem([8,21,24,28,31,33,37,0,0])   8725245 1
# localStorage_additem([6,17,24,30,31,32,36,0,0])   7625784 3
# localStorage_additem([8,17,24,30,32,36,37,0,0])   8694600 2

#  localStorage_additem([13,15,17,21,26,30,34,0,0]) 9857242 7


# 2023-03-05 22:50:41
# 含む当選回数の回数をカウントする
# if fcc = 4


def fcck(fcc):
    print(fcck.__name__)
    import csv
    import sqlite3

    if fcc != 4 and fcc != 5:
        print("ORGerror")
        return
    if fcc == 4:
        countmax = 3
        countshow = 16
        upsql = "update alll7 set fcck4=%d where id=%d;"
        pass
    if fcc == 5:
        countmax = 4
        countshow = 3
        upsql = "update alll7 set fcck5=%d where id=%d;"
        pass

    conn = sqlite3.connect("alll7.db")
    cursor1 = conn.cursor()
    cursor2 = conn.cursor()
    sql1 = "select s1,s2,s3,s4,s5,s6,s7,rowid from alll7;"
    sql1 = "select s1,s2,s3,s4,s5,s6,s7,rowid from alll7 where t1 > 533;"
    cursor1.execute(sql1)
    while True:
        re1 = cursor1.fetchone()
        # cursor1.fetchmany
        if re1 is None:
            print("re1end")
            break
        tag = [re1[0], re1[1], re1[2], re1[3], re1[4], re1[5], re1[6]]
        tagindex = re1[7]
        countc = 0

        sql2 = "select s1,s2,s3,s4,s5,s6,s7 from loto7"
        cursor2.execute(sql2)
        while True:
            re2 = cursor2.fetchone()
            if re2 is None:
                break
            count = 0
            for jj in re2:
                if jj in tag:
                    count += 1
            # 4つある
            if count > countmax:
                countc += 1
        # print(upsql % (countc, tagindex))
        conn.execute(upsql % (countc, tagindex))
        if countc > countshow:
            print("-------------------------------------------")
            print(str(tag) + "---" + str(tagindex) + "---" + str(countc))
            print("-------------------------------------------")
            conn.commit()
    conn.commit()
    conn.close()
    print(fcck.__name__)


# fcck(4)
# fcck(5)


# 三つ数字出る回数
def fcck373():
    print(fcck373.__name__)
    import sqlite3

    conn = sqlite3.connect("alll7.db")
    cursor1 = conn.cursor()
    cursor2 = conn.cursor()

    sql1 = "select s1,s2,s3,rowid from fcck37 "
    cursor1.execute(sql1)
    while True:
        re1 = cursor1.fetchone()
        cursor1.fetchmany
        if re1 is None:
            print("re1end")
            break
        tag = [re1[0], re1[1], re1[2]]
        tagindex = re1[3]
        countc = 0

        sql2 = "select s1,s2,s3,s4,s5,s6,s7 from loto7"
        cursor2.execute(sql2)
        while True:
            re2 = cursor2.fetchone()
            if re2 is None:
                break
            count = 0
            for jj in re2:
                if jj in tag:
                    count += 1
            if count == 3:
                countc += 1
            sql3 = "update fcck37 set fcck=%d where rowid=%d" % (countc, tagindex)
            conn.execute(sql3)
            conn.commit()
        if countc > 9:
            print("-------------------------------------------")
            print(str(tag) + "---" + str(tagindex) + "---" + str(countc))
            print("-------------------------------------------")
    print(fcck373.__name__)


# fcck373()


# 二つ数字出る回数
def fcck372():
    print(fcck372.__name__)
    import sqlite3

    conn = sqlite3.connect("alll7.db")
    cursor1 = conn.cursor()
    cursor2 = conn.cursor()

    sql1 = "select s1,s2,rowid from fcck372 "
    cursor1.execute(sql1)
    while True:
        re1 = cursor1.fetchone()
        cursor1.fetchmany
        if re1 is None:
            print("re1end")
            break
        tag = [re1[0], re1[1]]
        tagindex = re1[2]
        countc = 0

        sql2 = "select s1,s2,s3,s4,s5,s6,s7 from loto7"
        cursor2.execute(sql2)
        while True:
            re2 = cursor2.fetchone()
            if re2 is None:
                break
            count = 0
            for jj in re2:
                if jj in tag:
                    count += 1
            if count == 2:
                countc += 1
            sql3 = "update fcck372 set fcck=%d where rowid=%d" % (countc, tagindex)
            conn.execute(sql3)
            conn.commit()
        if countc > 9:
            print("-------------------------------------------")
            print(str(tag) + "---" + str(tagindex) + "---" + str(countc))
            print("-------------------------------------------")
    print(fcck372.__name__)


# 4つ数字の連続
def fcck374():
    print(fcck374.__name__)
    import sqlite3

    conn = sqlite3.connect("alll7.db")
    cursor1 = conn.cursor()
    cursor2 = conn.cursor()

    sql1 = "select s1,s2,s3,s4,rowid from fcck374"
    cursor1.execute(sql1)
    while True:
        re1 = cursor1.fetchone()
        cursor1.fetchmany
        if re1 is None:
            print("fcck374--end")
            break
        tag = [re1[0], re1[1], re1[2], re1[3]]
        tagindex = re1[4]
        countc = 0

        sql2 = "select s1,s2,s3,s4,s5,s6,s7 from loto7"
        cursor2.execute(sql2)
        while True:
            re2 = cursor2.fetchone()
            if re2 is None:
                break
            count = 0
            for jj in re2:
                if jj in tag:
                    count += 1
            if count == 4:
                countc += 1
            sql3 = "update fcck374 set fcck=%d where rowid=%d" % (countc, tagindex)
            conn.execute(sql3)
            conn.commit()
        if countc > 6:
            print("-------------------------------------------")
            print(str(tag) + "---" + str(tagindex) + "---" + str(countc))
            print("-------------------------------------------")
    print(fcck374.__name__)


# fcck374()
# print(nfcck([6, 10, 27, 30, 32, 33, 36], 1))  # 0==4


def numscount():
    print(numscount.__name__)
    import sqlite3

    com = [0] * 38
    dbname = "alll7.db"
    con = sqlite3.connect(dbname)
    sql = "select s1,s2,s3,s4,s5,s6,s7 from loto7"
    # sql = 'select loto7.s1,loto7.s2,loto7.s3,loto7.s4,loto7.s5,loto7.s6,loto7.s7 from loto7 join alll7 on loto7.z1= alll7.id where alll7.fcck4>13 '
    # sql = 'select loto7.s1,loto7.s2,loto7.s3,loto7.s4,loto7.s5,loto7.s6,loto7.s7 from loto7 join alll7 on loto7.z1= alll7.id where alll7.fcck5>3 '
    # sql = 'select s1,s2,s3,s4 from fcck374 where fcck =4'
    # sql = 'select s1,s2,s3,s4,s5,s6,s7 from loto7 limit 20'
    sql = "select s1,s2,s3,s4,s5,s6,s7 from loto7 where t1 > 533"
    # sql = "select s1,s2,s3 from fcck37 where fcck > 1"
    # sql = "select s1 ,s2 from fcck372 where fcck = 9"
    # sql = "select s1,s2,s3 from fcck37 where s1=12 and fcck > 4"
    # sql = "select s1,s2,s3,s4 from fcck374 where s1=12 and fcck > 2"
    # sql = "select s1,s2,s3 from fcck37 where fcck > 6 and (s1=15 or s2=15 or s3=15)"
    # sql = "select s1,s2,s3 from fcck37 where fcck > 0 and (s1=15 or s2=15 or s3=15)"
    # sql = "select s1,s2,s3,s4,s5,s6,s7 from loto7 where s1=15 or s2=15 or s3=15 or s4=15 or s5=15 or s5=15 or s7=15"
    # sql = "select s1,s2,s3,s4,s5,s6,s7 from loto7 where t1 > 450 and (s1=15 or s2=15 or s3=15 or s4=15 or s5=15 or s5=15 or s7=15)"
    # sql = "select s1,s2,s3,s4,s5,s6,s7 from loto7 where t1 > 500"
    # sql = "select s1,s2,s3,s4 from fcck374 where fcck >3"
    # sql = "select s1,s2,s3 from fcck37 where fcck >7"
    # sql = "select loto7.s1,loto7.s2,loto7.s3,loto7.s4, loto7.s5 ,loto7.s6 ,loto7.s7 from loto7 join alll7 on loto7.z1=alll7.id where fcck5 >2"

    cursor = con.cursor()
    cursor.execute(sql)
    while True:
        re = cursor.fetchone()
        # print(re)
        if re is None:
            break
        for v in re:
            com[v] += 1
    print(com)
    for v in range(38):
        if com[v] != 0:
            print(v, "--------", com[v] - 0)
    print(numscount.__name__)


def qqq(t1):
    import sqlite3

    con = sqlite3.connect("alll7.db")
    sql = "select s1,s2,s3,s4,s5,s6,s7 from loto7 where t1={}".format(t1)
    print(sql)

    cursor = con.cursor()
    cursor.execute(sql)
    f = cursor.fetchone()
    print(f)
    print(t1)
    nfcck([f[0], f[1], f[2], f[3], f[4], f[5], f[6]])
    nfcck2([f[0], f[1], f[2], f[3], f[4], f[5], f[6]])
    print(t1)
    print(f)


# 作成の途中
def qf():
    import sqlite3

    con = sqlite3.connect("alll7.db")
    sql1 = "select s1,s2,s3,s4,s5,s6,s7 from loto7 limit 3 "
    cur1 = con.cursor()
    cur1.execute(sql1)

    while True:
        re1 = cur1.fetchone()
        if re1 is None:
            break
        print(re1[0], re1[1], re1[2], re1[3], re1[4], re1[5], re1[6])
        if 11 in re1:
            print(re1)


t7()
# tag = [7,8,13,15,24,26,30,32]   出やすい数字
# tag = [1,3,6,13,14,26,29,31,32,34,35,36]
# tag = [5  , 8  , 15 , 26 , 32 , 34 , 36]
# tag = [11,14,17,18,21,25,31]
# tag = [11,15,18,22,23,30,36]

# nfcck(tag, 0)
# nfcck2(tag, 0)
# qqq(534)
# numscount()
# ta()
# qf()

# fcck(4)
# fcck(5)
# fcck373()
# fcck374()
# fcck372()
