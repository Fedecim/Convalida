# Convallida
**Introduzione alla Classe PHP "Convalida"**

La classe `Convalida` è stata ideata per gestire il processo di verifica e convalida dei dati di input provenienti da un form HTML. Questa classe offre un'implementazione efficiente e comprensiva per validare diversi tipi di input in base a regole personalizzate e chiaramente definite.

### Caratteristiche principali:

1. **Proprietà della classe:**
    - `**$valido**`: Un flag booleano che indica se l'input è stato convalidato con successo.
    - `**$errori**`: Un array che raccoglie gli eventuali messaggi di errore generati durante il processo di convalida.

2. **Metodo `check`**:
    - Accetta due parametri: un array `**$input**` che contiene i dati da convalidare e un array `**$parametri**` che definisce le regole di convalida.
    - Le regole di convalida sono flessibili e possono includere verifiche come:
        * **Presenza obbligatoria**: `required`
        * **Lunghezza minima e massima**: `length_min` e `length_max`
        * **Validazione dell'email**: `mailcheck`
        * E molte altre.
    - Per ogni input, il metodo verifica ogni regola specificata e, se si verifica un'infrazione, registra un messaggio di errore nell'array `**$errori**`.

3. **Metodi accessori**:
    - `**errori()**`: Restituisce l'array degli errori accumulati durante il processo di convalida.
    - `**valido()**`: Restituisce un valore booleano che indica se l'input è stato convalidato con successo.

4. **Metodo privato `add_error`**:
    - Usato internamente dalla classe per aggiungere un messaggio di errore all'array `**$errori**`.

### Esempio di Utilizzo:
