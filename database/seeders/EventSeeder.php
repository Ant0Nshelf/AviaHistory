<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Відкриття аеропорту "Ужгород"',
                'description' => 'Офіційне відкриття міжнародного аеропорту в Ужгороді, який став важливим транспортним вузлом для всього Закарпаття. Аеропорт розпочав регулярні рейси до Києва та інших міст України.',
                'event_date' => '1929-05-15',
                'location_id' => 1,
                'image_url' => 'https://zakarpattya.net.ua/postimages/news/2019/10/1570785316.jpg',
            ],
            [
                'title' => 'Перший міжнародний рейс з Ужгорода',
                'description' => 'Історична подія - перший міжнародний рейс з аеропорту "Ужгород" до Праги. Цей рейс відкрив нові можливості для міжнародного сполучення регіону.',
                'event_date' => '1930-07-22',
                'location_id' => 1,
                'image_url' => 'https://static.ukrinform.com/photos/2018_05/thumb_files/630_360_1526386452-763.jpg',
            ],
            [
                'title' => 'Заснування Мукачівського аеродрому',
                'description' => 'Відкриття аеродрому в Мукачеві, який спочатку використовувався для військових цілей, а пізніше став важливим центром цивільної авіації в регіоні.',
                'event_date' => '1935-03-10',
                'location_id' => 2,
                'image_url' => 'https://zakarpattya.net.ua/postimages/news/2020/02/1582037574.jpg',
            ],
            [
                'title' => 'Відкриття Музею авіації Закарпаття',
                'description' => 'Урочисте відкриття музею, присвяченого історії розвитку авіації в Закарпатському регіоні. У музеї представлені експонати, що розповідають про розвиток авіації від перших польотів до сучасності.',
                'event_date' => '1975-09-05',
                'location_id' => 3,
                'image_url' => 'https://zakarpattya.net.ua/postimages/news/2019/05/1558084845.jpg',
            ],
            [
                'title' => 'Реконструкція аеропорту "Ужгород"',
                'description' => 'Масштабна реконструкція аеропорту "Ужгород", яка включала оновлення злітно-посадкової смуги, терміналу та інших об\'єктів інфраструктури.',
                'event_date' => '1985-11-20',
                'location_id' => 1,
                'image_url' => 'https://static.ukrinform.com/photos/2021_10/thumb_files/630_360_1634822887-882.jpg',
            ],
            [
                'title' => 'Перший політ на повітряній кулі над Ужгородом',
                'description' => 'Історична подія - перший політ на повітряній кулі над Ужгородом, який привернув увагу багатьох жителів міста та став початком розвитку повітроплавання в регіоні.',
                'event_date' => '1992-06-15',
                'location_id' => 1,
                'image_url' => 'https://zakarpattya.net.ua/postimages/news/2018/06/1528632030.jpg',
            ],
            [
                'title' => 'Відновлення роботи Хустського аеродрому',
                'description' => 'Після тривалого періоду занепаду, Хустський аеродром відновив свою роботу. Було проведено ремонт злітно-посадкової смуги та інших об\'єктів інфраструктури.',
                'event_date' => '2005-08-12',
                'location_id' => 4,
                'image_url' => 'https://zakarpattya.net.ua/postimages/news/2020/07/1594902545.jpg',
            ],
            [
                'title' => 'Міжнародний авіаційний фестиваль у Мукачеві',
                'description' => 'Перший міжнародний авіаційний фестиваль у Мукачеві, який зібрав пілотів та любителів авіації з різних країн. Фестиваль включав показові польоти, виставку авіаційної техніки та інші заходи.',
                'event_date' => '2010-09-25',
                'location_id' => 2,
                'image_url' => 'https://zakarpattya.net.ua/postimages/news/2019/09/1568639845.jpg',
            ],
            [
                'title' => 'Відкриття нового терміналу в аеропорту "Ужгород"',
                'description' => 'Урочисте відкриття нового пасажирського терміналу в аеропорту "Ужгород", який відповідає сучасним міжнародним стандартам та здатний обслуговувати більшу кількість пасажирів.',
                'event_date' => '2015-05-30',
                'location_id' => 1,
                'image_url' => 'https://static.ukrinform.com/photos/2022_05/thumb_files/630_360_1652967124-504.jpg',
            ],
            [
                'title' => 'Перший політ дронів над Закарпаттям',
                'description' => 'Перша офіційна демонстрація можливостей дронів у Закарпатті. Було проведено показові польоти та презентовано різні сфери застосування цієї технології.',
                'event_date' => '2018-07-10',
                'location_id' => 3,
                'image_url' => 'https://zakarpattya.net.ua/postimages/news/2020/10/1603281845.jpg',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
