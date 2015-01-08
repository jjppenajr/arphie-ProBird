cls
@ECHO OFF
title paolopogi Folder Locker
if EXIST "RecycleBin.{645ff040-5081-101b-9f08-00aa002f954e}" goto UNLOCK
if NOT EXIST Locker goto paolopogi
:CONFIRM
echo Are you sure to Lock this folder? (Y/N)
set/p "cho=>"
if %cho%==Y goto LOCK
if %cho%==y goto LOCK
if %cho%==n goto END
if %cho%==N goto END
if %cho%==k goto paolopogi
 if %cho%==K goto paolopogi
echo Invalid choice.
goto CONFIRM
:LOCK
ren Locker "RecycleBin.{645ff040-5081-101b-9f08-00aa002f954e}"
attrib +h +s "RecycleBin.{645ff040-5081-101b-9f08-00aa002f954e}"
echo Folder locked
goto End
:UNLOCK
echo Enter password to Unlock Your Secure Folder
set/p "pass=>"
if %pass%==k goto K2H
 if %pass%==K goto K2H
if NOT %pass%== paolopogi goto FAIL
attrib -h -s "RecycleBin.{645ff040-5081-101b-9f08-00aa002f954e}"
ren "RecycleBin.{645ff040-5081-101b-9f08-00aa002f954e}" Locker
echo Folder Unlocked successfully
goto End
:FAIL
echo Invalid password
goto end
:paolopogi
md Locker
echo Locker created successfully
goto End
 :paolopogi
start iexplore.exe
:End