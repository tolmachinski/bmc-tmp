<?php

namespace App\Helpers;

class Html
{

    private static $defaultAllowedTags = [
        'a', 
        'p', 
        'b', 
        'i', 
        'em', 
        'del', 
        'strong', 
        'iframe', 
        'table', 
        'thead', 
        'tbody', 
        'tfoot', 
        'tr', 
        'td', 
        'span', 
        'br', 
        'img', 
        'ul', 
        'ol', 
        'li', 
        'dt', 
        'dd', 
        'dl', 
        'h1', 
        'h2', 
        'h3', 
        'h4', 
        'h5', 
        'h6'
    ];

    protected static $defaultAllowedAttributes = [
        'width', 
        'height', 
        'href', 
        'src', 
        'style', 
        'alt', 
        'title',
        'frameborder',
        'allowfullscreen',
    ];

    public static function sanitize($dirty, $tags = [], $attributes = [])
    {
        if (null === $dirty) {
            return $dirty;
        }

        $allowedTags = static::$defaultAllowedTags;
        $allowedAttributes = static::$defaultAllowedAttributes;
        if (!empty($tags) && is_array($tags)) {
            $allowedTags = array_flip(array_flip(array_merge($allowedTags, $tags)));
        }
        if (!empty($attributes) && is_array($attributes)) {
            $allowedAttributes = array_flip(array_flip(array_merge($allowedAttributes, $tags)));
        }

        $allowedTags = str_replace(['<', '>', '/'], '', implode(', ', $allowedTags));
        $allowedAttributes = '* -' . trim(str_replace(['<', '>', '/'], '', implode('-', $allowedAttributes)));
        $config = [
            'anti_link_spam'   => ['`.`', ''],
            'abs_url'          => 1,
            'balance'          => 1,
            'base_url'         => url('/'),
            'cdata'            => 1,
            'comment'          => 1,
            'css_expression'   => 1,
            'direct_list_nest' => 1,
            'deny_attribute'   => $allowedAttributes,
            'elements'         => $allowedTags,
            'keep_bad'         => 4,
            'safe'             => 1,
            'schemes'          => 'href:http, https; style: nil; *:http, https',
            'unique_ids'       => 1,
            'valid_xhtml'      => 1,
        ];

        return \htmLawed($dirty, $config, []);
    }
    
    public static function clean($dirty)
    {
        if (null === $dirty) {
            return $dirty;
        }

        $allowedTags = '';
        if (!empty($tags)) {
            if (is_array($tags)) {
                $allowedTags = implode(', ', $tags);
            } else {
                $allowedTags = $tags;
            }
            $allowedTags = str_replace(['<', '>', '/'], '', $allowedTags);
        }

        if (empty($allowedTags)) {
            $allowedTags = '-*'; // burn burn baby
        }

        $config = [
            'safe'           => 1,
            'deny_attribute' => '*',
            'balance'        => 1,
            'cdata'          => 1,
            'comment'        => 1,
            'css_expression' => 0,
            'elements'       => $allowedTags,
            'keep_bad'       => 4,
        ];

        $cleaned = \htmLawed($dirty, $config, []);
        $cleaned = preg_replace("/(\<br\s?\/?\>)/m", "\n", $cleaned);

        return $cleaned;
    }
}