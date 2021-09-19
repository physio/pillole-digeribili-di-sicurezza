# Database Definition

The purpose of this document is to describe the database and define how data should be stored and accessed.

## MariaDB tables

The MariaDB Table holds the anagraphic data (Identity Cards, Users, …).

### Entities

Saved entities are:

- **IdentityCards** the idienty card is the example that i choos for the dimostration. The purpose is show as a entity can securely stored.
- **User** a user able to login to the system.


#### IdentityCard Attributes <a id="id"></a>

| Name         | Type   | Notes            | Example             |
| ------------ | ------ | ---------------- | ------------------- |
| id           | number | Incremental      | 1234                |
| name         | string |                  | Dunder Mifflin      |
| businessName | string | Ragione Soc.     | Dunder Mifflin Inc. |
| nodeType     | enum   |                  | factory             |
| note         | string |                  |                     |
| owner        | nodeId | null if root org | def456              |
