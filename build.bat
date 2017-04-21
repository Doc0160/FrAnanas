@echo off
set msg=%*
if "%msg%" equ "" (
   set msg=%date%-%time%
)
echo.
echo --- git status ---
git status
echo.
echo --- git pull ---
git pull
echo.
echo --- git add . ---
git add .
echo.
echo --- git commit -m "%msg%" ---
git commit -m "%msg%"
echo.
echo --- git push ---
git push
echo.
