In tutta la serie composta da 4videolezioni più la 3a in 2 versioni (completa con la scrittura del codice e compressa con solo la spiegazione del codice):
1) lista di items estratti da un data base, non una lista in un un'unica pagina, ma paginata;
2) cambiamento dell'ordine degli items attraverso un drag and drop
3) salvataggio istantaneo del nuovo ordine con ajax
4) soluzione nel caso in cui la nuova posizione di un item sia da portare su un'altra pagina 


1Parte - Creazione lista degli elementi, inserimento ed estrazione dal database
Iniziamo col dire i prerequisiti (#PHP, #MySQL, #ServerLocale, #HTML5, #CSS3, #Javascript, #jQuery), poi passiamo alla cosa alla base di ogni applicazione la creazione del database, riempiamo il database creato con dati provenienti dal API di YouTube del mio canale e verifichaimo in fine che tutto ci sia 
http://youtu.be/QUpf4yLi6lY 

2Parte - Mark up in HTML5 e CSS3 con tools di sviluppo WEB
Ora che abbiamo la lista degli elementi nel database e riusciamo ad estrarla, cose cha abbiamo fatto nella prima parte di questa serie di videolezioni [http://youtu.be/QUpf4yLi6lY],
Possiamo finalmente creare il mark up HTML5 utilizzando I moderni tools di sviluppo WEB 1 - Boilerplate HTML5; 2 - Twitter Bootstrap 3; 4 - jQuery e jQuery UI per il drag and drop
Quindi alla fine della videolezione avremo una lista di oggetti estratti dal database e sorteggiabili graficamente con il drag and drop cioe con il trascinamento diretto sulla pagina.
https://youtu.be/55XOeup0nbE

3Parte - Ajax per salvare nel database le posizioni
Impostiamo gli eventi javascript perc cattarura il trascinamento da parte del utente e quando l-elemento trascinato viene spostato e rilasciato, scateniamo un evento javascript che crea una chiamata ajax e invia la nuova posizione $newPosition e l'id del elemento $id.
Nel PHP con questi dati estraiamo la posizione vecchia del elemento spostiamo tutti gli altri elementi o su di 1 o giu di 1 e salviamo tutto nel database.
compressa - https://youtu.be/dfEPZxrgDHY
completa - http://www.youtube.com/watch?v=X3VJkaHPS5Q

4Parte - 
Nella parte finale sulla lista di elementi estratti dal database da ordinare con il drag and drop grazie al Ajax e alla libreria MySQLi di PHP:
Come primo passo faciamo funzionare la paginazione prima con solo il PHP e $_GET e poi in Ajax quindi senza ricaricamento pagina. Poi facciamo in modo che gli elementi si salvino anche sulle altre pagine quindi aggiungendoli il numero pagina x 10 $newPosition = $p * 10 + $newPosition;
E finalmente il cambio posizione su più pagine trascinando l'elemento sul numero pagina e rilasciandolo, cosi finisce in prima posizione sulla pagina in questione, per poi spostarlo da li nella posizione in mezzo agli elementi di quella pagina. 
http://youtu.be/3FL7Ec3t9Wc

CODICE: https://github.com/withArtur/jowa


Facebook (#Suggerimenti, #Domande, #BellaCiao)
https://www.facebook.com/withArtur

Secondo Canale dedicato al VG [OBIV].it
https://www.youtube.com/user/VideoGiornaleOBIV

Canale originale di Artur Mamedov aka #withArtur
https://www.youtube.com/user/MamedovArtur1993

http://www.obiv.it/
E il WebSite da dove parti tutto
http://www.webfab.it/

P.S. Musiche e contenuti esterni presi da:
http://www.freesound.org/
