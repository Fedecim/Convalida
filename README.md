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

---

## **Form HTML**

```html
<form>
    <input type="text" name="email">
    <input type="submit">
</form>
```

## **Utilizzo della Classe**

```php
$convalida = new Convalida();
$verifica = $convalida->check($_POST, array(
    'email' => array(
        'required' => true,
        'mailcheck' => true
    )
));

if ($verifica) {
    echo "L'input è stato convalidato con successo!";
} else {
    $errori = $convalida->errori();
    foreach($errori as $errore) {
        echo $errore . "<br>";
    }
}
```

### **Dettagli dell'Implementazione**
- **Creazione di un'istanza e invocazione del metodo `check`**:
    - **Primo parametro (`$_POST`)**: Rappresenta l'array associativo contenente tutti i dati inviati dal form.
    - **Secondo parametro**: Un array associativo delle regole di convalida.
        * La chiave (in questo esempio, `'email'`) corrisponde all'attributo `name` del campo input nel form.
        * Le regole di validazione sono sottocampi all'interno di questa chiave. Nel nostro esempio, l'email deve essere:
            1. Obbligatoria: `'required' => true`
            2. Una email valida: `'mailcheck' => true`

- **Gestione dei Risultati**:
    * Se la funzione `check` restituisce `true`, l'input è valido e viene visualizzato un messaggio di successo.
    * In caso contrario, vengono elencati gli errori di convalida.

---

Con questo setup, ci assicuriamo che l'input email fornito sia sia obbligatorio che conforme a un formato email valido.