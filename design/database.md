# Database Definition

The purpose of this document is to describe the database and define how data should be stored and accessed.

## MariaDB tables

The MariaDB Table holds the anagraphic data (Identity Cards, Users, …).

### Entities

Saved entities are:

- **IdentityCards** the idienty card is the example that i choos for the dimostration. The purpose is show as a entity can securely stored.
- **User** a user able to login to the system.


#### IdentityCard Attributes <a id="id"></a>

| Name           | Type    | Notes            | Example             |
| -------------- | ------- | ---------------- | ------------------- |
| id             | number  | Incremental      | 1234                |
| documentType   | string  |                  | patente             |
| documentNumber | encrypt |                  | xxxxxxxxxxxx        |


#### UserTrace Attributes <a id="id"></a>

| Name           | Type    | Notes            | Example             |
| -------------- | ------- | ---------------- | ------------------- |
| id             | number  | Incremental      | 1234                |
| user_id        | number  |                  | 1234                |
| fingerprint    | string  |                  | xxxxxxxxxxxx        |
| action         | string  |                  |         |
