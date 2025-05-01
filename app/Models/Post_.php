<?php

namespace App\Models;


class Post 
{
    private static $koleksi_post = [
        [
            "title" => "Museum Nasional",
            "slug" => "judul-museum-pertama",
            "lokasi" => "Indonesia",
            "deskripsi" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eius architecto odit illo harum quibusdam adipisci dignissimos tenetur dolore consequuntur numquam rerum reprehenderit, ipsam excepturi nihil et suscipit incidunt voluptatem."
        ],
        [
            "title" => "Museum Perjuangan",
            "slug" => "judul-museum-bogor",
            "lokasi" => "Bogor-Jawa Barat",
            "deskripsi" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sed suscipit repudiandae ex labore aperiam minima necessitatibus ea impedit error laborum. Obcaecati nesciunt quam dolorem quasi esse possimus dolore officiis soluta quos minus. Dolorum cumque quisquam eligendi quo magnam. Repudiandae omnis laboriosam saepe maiores, autem dignissimos debitis molestias officia distinctio, dicta consequatur enim harum facilis, atque ullam? Hic, labore. Soluta aliquam, quasi ab architecto atque culpa reprehenderit asperiores veritatis quas maxime temporibus, quia libero tempora quis magni enim dicta praesentium. Debitis distinctio quaerat dolorum hic ipsum alias vitae sint, eos quis ad, commodi pariatur. Natus quibusdam modi, sit veniam voluptate provident."
        ]
    ];

    public static function all()
    {
        return collect(self::$koleksi_post);
    }


    public static function find($slug)
    {
        $slug = trim($slug); //solusi error Trying to access array offset on null

        $posts = static::all();
        // dd($posts);
        return $posts->firstWhere('slug', $slug);
    }

}
