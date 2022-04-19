<?php

namespace Database\Seeders;

use App\Models\Billplz\CommentByBill;
use Illuminate\Database\Seeder;

class CommentByBillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'bill_id'          => 1, 
                'comment_content'   => 'Alhamdulillah semoga dipermudahkan',  
            ],
            [
                'bill_id'          => 2, 
                'comment_content'   => 'Lorem ipsum dolor sit amet.',
            ],
            [
                'bill_id'          => 3, 
                'comment_content'   => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati, esse?',  
            ],
            [
                'bill_id'          => 4, 
                'comment_content'   => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam incidunt possimus dolorem minima reprehenderit reiciendis, nesciunt voluptas molestiae quidem nemo.',  
            ],
            [
                'bill_id'          => 5, 
                'comment_content'   => 'Lorem Ipsum is simply dummy text of the printing and typesettingLorem ipsum dolor sit amet consectetur adipisicing elit. Vero necessitatibus corrupti nostrum nesciunt voluptatem. Accusantium beatae officiis nesciunt, dignissimos provident fugiat qui repellat aperiam ut debitis amet, ullam, rerum rem',  
            ],
        ];

        foreach($comments as $comment) {
            CommentByBill::create($comment);
        }
    }
}
