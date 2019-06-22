# Вопрос
Существует таблица, в которой хранятся записи о неких событиях (например, выставки или фестивали). Необходимо написать код, который выводил бы на экран события, которые проходят на этой неделе.

Данные в таблице описаны следующими полями:
```
id int not null primary key
name text
begin_date datetime // дата начала события
end_date datetime // дата окончания события
```
---
# Ответ
Для запроса можно использовать SQL-функцию YEARWEEK(date).

* Структура таблицы описана в файле **events.sql**
* Запрос к БД и вывод данных находятся в файле **index.php**