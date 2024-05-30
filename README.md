# SUPREMO

## Technologie
- **PHP**
- **JavaScript**
- **HTML5**
- **CSS**

## Jak uruchomić program

1. **Zainstaluj aplikację XAMPP**  
   Pobierz i zainstaluj XAMPP z [tego linku](https://sourceforge.net/projects/xampp/files/latest/download).
   Podczas pobierania aplikacji zainstaluj moduł `Apache` oraz `mySQL`
   
2. **Skopiuj pliki projektu**  
   Przejdź do folderu, w którym zainstalowany jest XAMPP, a następnie do folderu `htdocs`, tam utwórz folder `supremo`.
   ```bash
   cd /ścieżka/do/xampp/htdocs
   ```
   Pobierz repozytorium, a następnie przenieś jego zawartość do folderu `supremo`.
   
3. **Wyłącz wszystkie usługi mySQL działające na komputerze**
   
4. **Włącz jako administrator aplikację xampp, następnie włącz moduł `Apache` oraz `MySQL`**
   
![supremo 3](https://github.com/elzyr/Supremo/assets/35708857/fa4639b4-9ee0-418d-9d11-571313c110d4)


5. **W module MySQL wejdź w zakładke `Admin`**
   
6. **Po lewej stronie ekranu naciśnij przycisk `new`, nazwij nową bazę danych `supremo`.**

  ![supremo 2](https://github.com/elzyr/Supremo/assets/35708857/ff572bf5-f2cb-4326-baaa-5f9d72b9df95)
  
  ![supremoo](https://github.com/elzyr/Supremo/assets/35708857/4ac26fde-47dd-43a7-a8f6-2960a7cac52d)


7. **Następnie wejdź w zakladkę `import` i wybierz plik `supremo.sql` z folderu supremo. Naciśnij przycisk `import` na samym dole ekranu.**
    
    ![supremo 4](https://github.com/elzyr/Supremo/assets/35708857/2bda0bb5-35a1-406e-9b9f-a834eefd47a0)

8. **Teraz wejdź na http://localhost/supremo/loading-page.php**
