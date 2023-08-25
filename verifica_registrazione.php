
import sqlite3
from werkzeug.security import generate_password_hash

# Connessione al database (crea il database se non esiste)
conn = sqlite3.connect('miodatabase.db')
cursor = conn.cursor()

# Crea la tabella utenti (se non esiste)
cursor.execute('''
    CREATE TABLE IF NOT EXISTS utenti (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nome_utente TEXT NOT NULL,
        email TEXT NOT NULL,
        password TEXT NOT NULL
    )
''')

def registra_utente(nome_utente, email, password):
    hashed_password = generate_password_hash(password)
    cursor.execute('INSERT INTO utenti (nome_utente, email, password) VALUES (?, ?, ?)',
                   (nome_utente, email, hashed_password))
    conn.commit()

def verifica_utente(nome_utente, password):
    cursor.execute('SELECT id, nome_utente, password FROM utenti WHERE nome_utente = ?', (nome_utente,))
    utente = cursor.fetchone()
    if utente and utente[1] == nome_utente and check_password_hash(utente[2], password):
        return True, utente[0]  # Utente verificato e ID utente
    return False, None  # Utente non trovato o password errata

# Esempi di utilizzo
registra_utente('alice', 'alice@example.com', 'password123')
verificato, utente_id = verifica_utente('alice', 'password123')
if verificato:
    print('Utente verificato con ID:', utente_id)
else:
    print('Verifica fallita')

# Chiudi la connessione al database alla fine
conn.close()
