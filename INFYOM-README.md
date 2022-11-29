# Jak používat InfyOm API Generátor

> ### Na co vždy pamatovat
> - Generátor generuje vždy stejný osah, který je nutné ručně doupravit!
> - Vždy překontrolujte všechny funkce, které od vygenerované části potřebujete před vytvořením `Pull Request`.
> - Prověřit všechny testy před publikováním `Pull requestu`.

## Jak generovat obsah

Pro generaci obsahu slouží příkaz `php artisan infyom`

**⚠️️ Většina příkazů při opakovaném použití vytvoří duplicity** Je nutné si vždy kontrolovat kód! **DUplicita vznikne u
migrací! Pokut do kód vyžaduje je třeba duplicitní migrace smazat.**

### Obecná vlastnosti

`$MODEL_NAME` - Název modelu, který se má vygenerovat. Zadávejte ve tvaru `MyModelName`. _Použije se
všude, `controllers`, `routes`, `Repository`, `Test` ..._

> ℹ️ Alternativní použití z již existující struktury `sail artisan infyom:api Clip --fieldsFile=Clip.json`.
>
> ⚠️ Pozor na přegenerování `factory`, doporučuji podívat se a překontrolovat vždy ručně. Datové struktury generované
> PHP Fakerem po přegenerování nemusí sedět! Kontrolujte vůči původní verzi z GIT nebo IDE Local History.

Ukázka použití `php artisan infyom:api Company`. `Scaffold` se v tomto projektu nepoužívá, jelikžo generuje části pro
administrační rozhraní a view.

|                                                                                                           |                                       |
|-----------------------------------------------------------------------------------------------------------|---------------------------------------|
| [Field Inputs](https://www.infyom.com/open-source/laravelgenerator/docs/8.0/getting-started#field-inputs) | Dokumentace parametrů                 |
| [Oficiální dokumentace](https://www.infyom.com/open-source/laravelgenerator/docs/8.0/getting-started)     | Oficiální dokumentace                 |
| [Skip File Generation](https://infyom.com/open-source/laravelgenerator/docs/generator-options#skip-file-generation)                                                                                                      | Informace k přeskočení prvků generace |

Ukázka skip generation `sail artisan infyom:api Clip --fieldsFile=Clip.json --skip=migration`

Pokud je třeba generovat jen určité soubory, po jednom, [návod zde](https://infyom.com/open-source/laravelgenerator/docs/generator-commands).

Příklad generování pouze modelu z `JSON` souboru - `sail artisan infyom:model Tag --fieldsFile=Tag.json`.

### Odebrání všecho co jsem přidal - rollback

`php artisan infyom:rollback $MODEL_NAME` - Odebere vše co je vázáno k `$MODEL_NAME`. **⚠️️ Také i `controllers`
, `views` a další, které již mohli existovat dříve!** Jako `type` lze použít třeba písmeno `d`, vyhodí to sice error,
ale odebere vše co je svázáno s `$MODEL_NAME`.

### Seeds

Po vytvoření nové datové struktury (tabulky) je dobré přidat data do [seederu](database/seeders/DatabaseSeeder.php), který data generuje pro testovací účely.

## Upravení dat po generaci

Pokud je třeba uvnitř view přidat možnosti provázání tabulek. Jinak není třeba nic upravovat.
