SET pver=python-3.7.9-embed-win32
SET pver=python-3.9.0-embed-win32

%HOMEPATH%\Desktop\%pver%\python.exe -m http.server 80 --bind 192.168.137.1  --directory %HOMEPATH%\Desktop\memo
%HOMEPATH%\Desktop\%pver%\python.exe -m http.server 80 --bind 192.168.137.33 --directory %HOMEPATH%\Desktop\memo

%HOMEPATH%\Desktop\%pver%\python.exe -m http.server 80 --bind 192.168.11.102 --directory %HOMEPATH%\Desktop\memo
%HOMEPATH%\Desktop\%pver%\python.exe -m http.server 80 --bind 192.168.11.105 --directory %HOMEPATH%\Desktop\memo
%HOMEPATH%\Desktop\%pver%\python.exe -m http.server 80 --bind 192.168.11.108 --directory %HOMEPATH%\Desktop\memo
