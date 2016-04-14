# TrEx

Se doreste dezvoltarea unei aplicatii Web cu rol de asistent financiar. 
Utilizatorii autentificati vor putea tine evidenta cheltuielilor, organizate in diferite categorii (e.g., cheltuieli privitoare la subzistenta ori vizand studiile, investitii, petrecerea timpului liber). 

Sistemul va oferi suport pentru crearea de grupuri de utilizatori -- de exemplu, adaugarea mai multor conturi in grupuri ca 'Familie' sau 'GETA' --, astfel incat sa se poata monitoriza cheltuielile tuturor membrilor apartinand unui anumit grup. 

Se vor genera si diferite rapoarte -- de exemplu, luna cu cele mai multe/putine achizitii de hartie si acuarele, cheltuielile de vacanta efectuate de catre un grup de prieteni, cheltuielile utilizatorilor in functie de varsta/areal geografic etc. --, disponibile in formatele HTML, XML si JSON.

Bonus: implementarea suportului pentru monede virtuale.

1.	Modul persistenta
1.1.	Arhitectura tabele baza de date
1.2.	Legatura intre baza de date si aplicatie
2.	Modulul de securitate
2.1.	Implementarea sistemului criptare a parolelor in baza de date
2.1.1.	Pentru a asigura securitatea parolelor in baza de date vom salva un hash al parolei concatenata cu emailul utilizatorului. In momentul autentificarii vom genera hash al datelor de autentificare introduse de utilizator si le vom compara cu hashul existent in baza de date.
2.2.	Protectie impotriva sql injection cross-server scripting	
2.2.1.	To be discused
2.3.	Separare acces interfata publica/privata
2.3.1.	To be discused
3.	Modulul de autentificare/inregistrare
3.1.	Pagina de inregistrare cont utilizator nou
3.1.1.	Pagina de inregistrare cont va permite utilizatorilor sa isi creeze un cont nou prin completarea unui formular.
3.2.	Sistemul de autentificare utilizator prin username/parola
4.	Modul interfata privata
4.1.	Sectiunea Profil
4.1.1.	Setari profil, schimbare parola, editare date personale.
4.2.	Sectiunea Management buget
4.2.1.	Adaugare buget anual /lunar/saptamanal (Sumele adaugate aici vor fi folosite pentru a deduce cheltuielile) 
4.3.	Sectiunea management cheltuieli
4.3.1.	Adaugare cheltuieli personale sau de grup. In aceasta sectiune utilizatorul v-a putea sa isi adauge cheltuieli alegand a categorie si o subcategorie(din sectiunea categorii) si o suma de bani ( care v-a fi dedusa din bugetul setat in sectiunea buget).
4.4.	Sectiunea categorii si subcategorii
4.4.1.	In aceasta sectiunea utilizatorul v-a putea defini categorii si subcategorii in care sa incadreze cheltuielile. Vor exista un set de categorii predefinite.
4.5.	Sectiunea grupuri de utilizatori
4.5.1.	In aceasta sectiune utilizatorului i se va permite sa creeze grupuri noi de utilizatori. Se vor putea adauga utilizatori in aceste grupuri care vor trebui sa accepte in prealabil invitatia la grup. Utilizatorilor din grup le vor fi vizibile doar categoriile de baza si categoriile create in interfata grupului. Creatorul grupului va avea rolul de administrator al grupului, putand adauga sau sterge utilizatori si sterge categorii. Toti utilizatorii grupului vor putea adauga categorii. 
4.6.	Sectiunea rapoartare
4.6.1.	In aceasta sectiune utilizatorul v-a putea genera rapoarte cu cheltuielile pe un anumit interval de timp si pe un anumit set de categorii selectate.
