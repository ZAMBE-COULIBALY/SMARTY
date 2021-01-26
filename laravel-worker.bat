SETCONSOLE /HIDE
@echo off
php "C:\Users\Gilles Armand N'DAH\Documents\Projets\SMARTY\artisan" queue:work database --sleep=3 --tries=3 >test.txt
