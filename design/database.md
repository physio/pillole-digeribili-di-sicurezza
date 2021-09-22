# Database Definition

The purpose of this document is to describe the database and define how data should be stored and accessed.

## MariaDB tables

The MariaDB Table holds the anagraphic data (Identity Cards, Users, …).

### Entities

Saved entities are:

- **IdentityCards** the idienty card is the example that i choos for the dimostration. The purpose is show as a entity can securely stored.
- **User** a user able to login to the system.



#### Action Attributes <a id="id"></a>

| Name           | Type    | Notes            | Example             |
| -------------- | ------- | ---------------- | ------------------- |
| id             | number  | Incremental      | 1234                |
| user_id        | number  |                  | xxxxxxxxxxxx        |
| fingerprint    | string  |                  | xxxxxxxxxxxx        |
| action         | string  |                  |         |


#### IdentityCard Simplies <a id="id"></a>
| Name           | Type    | Notes            | Example             |
| -------------- | ------- | ---------------- | ------------------- |
| id             | number  | Incremental      | 1234                |
| documentType   | string  |                  | patente             |
| documentNumber | string  |                  | eyJpdiI6Im85dU1oand |



#### Rsas <a id="id"></a>
| Name           | Type    | Notes            | Example             |
| -------------- | ------- | ---------------- | ------------------- |
| id             | number  | Incremental      | 1234                |
| documentType   | string  |                  | patente             |
| documentNumber | encrypt | Encrypted        | 0s��[?�~q���D�x���f |



#### Aess <a id="id"></a>
| Name           | Type    | Notes            | Example             |
| -------------- | ------- | ---------------- | ------------------- |
| id             | number  | Incremental      | 1234                |
| documentType   | string  |                  | patente             |
| documentNumber | string  |                  | eyJpdiI6Im85dU1oand |