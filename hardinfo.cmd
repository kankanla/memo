@echo off

rem --WinPE_systeminfo--
set infopath=n:\TestLog\%osname%PElog.txt
ping -n 6 127.0.0.1 >nul
echo %infopath%

rem goto ext

echo -  >>%infopath%
echo --WinPE_systeminfo---------------------------------------------------------- >>%infopath%
echo %date:~0,4%%date:~5,2%%date:~8,2% >>%infopath%
echo %date%   %time% >>%infopath%
rem wmic path Win32_BaseBoard get Manufacturer,product,SerialNumber,Version | find /V "ZZZ" >>%infopath%
wmic path Win32_BaseBoard get product | find /V "ZZZ" >>%infopath%
wmic path Win32_BIOS get SMBIOSBIOSVersion,ReleaseDate | find /V "ZZZ" >>%infopath%
wmic path Win32_Processor get Name,CurrentClockSpeed | find /V "ZZZ" >>%infopath%
rem wmic path win32_videocontroller get AdapterCompatibility,VideoProcessor,Name | find /V "ZZZ" >>%infopath%
wmic path Win32_PhysicalMemory get Manufacturer,PartNumber,SerialNumber,ConfiguredClockSpeed,Speed | find /V "ZZZ" >>%infopath%
wmic path Win32_DiskDrive get Model,Size,SerialNumber | find /V "ZZZ" >>%infopath%
wmic path Win32_NetworkAdapter where "NetEnabled=true" get Name,MACAddress | find /V "ZZZ" >>%infopath%
echo ----------------------------------------------------------WinPE_systeminfo-- >>%infopath%

rem --filecopy--
rem robocopy 

rem --Restore--
diskpart /s n:\file\CreatePartitions-UEFI.txt
wmic path Win32_BIOS get SMBIOSBIOSVersion,ReleaseDate
dism /Apply-Image /ImageFile:n:\imaegX\KM2-2-B650GPW\B650GPW.wim /Index:1 /ApplyDir:W:\
dism /Apply-Image /ImageFile:n:\imaegX\KM2-1-PROB650MA\PROB650MA.wim /Index:1 /ApplyDir:W:\
dism /Apply-Image /ImageFile:n:\imaegX\KM1-A520M-ITX-AC-80PCS\KM1-A520M-ITX-AC-80PCS.wim /Index:1 /ApplyDir:W:\
dism /Apply-Image /ImageFile:N:\imaegX\KGSC-20240616PC42\IP4-20240616PC42.wim /Index:1 /ApplyDir:W:\

W:\Windows\System32\bcdboot W:\Windows /s S:
echo wait
ping -n 6 127.0.0.1 >nul
wpeutil reboot


:ext
echo error
exit