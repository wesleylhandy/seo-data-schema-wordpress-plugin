# SEO-friendly Data-Schema with Options Pages

This plugin adds Books, Events, and FAQ Options pages to a Wordpress Site. The data structures were designed with Google Structured Data and Schema.org schema in mind: [Book](https://developers.google.com/search/docs/data-types/book), [Event](https://developers.google.com/search/docs/data-types/event), and [FAQ](https://developers.google.com/search/docs/data-types/faqpage). The plugin allows Editors and Administrators to enter Rich Context from the Admin UI and allows Developers to iterate over each set of data within themes, plugins, and pages, to create SEO-rich content. 

Currently, this plugin does not create Custom Post Types though that feature is under consideration. If these types are exported to a SSG, then a decision on which content is canonical must be made.

## Required Plugins

 - ACF https://www.advancedcustomfields.com/
 - ACF Pro https://www.advancedcustomfields.com/pro/

### Recommended Optional Plugins

The following plugins will expose your entire site to GraphQL, which can be viewed form the WP Admin or exported via SSG plugins such as `gatsby-source-graphql`. This gives you an easy, visual representation of existing data for continued development.

 - WP GraphiQL https://wpgraphql.com/
 - WP GraphQL https://github.com/wp-graphql/wp-graphql
 - WPGraphQL for Advanced Custom Fields https://wpgraphql.com/acf

## Usage

For Developers, after installing the required plugins, then activating this plugin, three options pages will be added near the top of the Admin Menu: **Books**, **Events**, and **FAQs**

These pages enable you to use [ACF functions](https://www.advancedcustomfields.com/resources/) like `have_rows`, `get_field`, and `get_sub_field` to access the data.

For **Books**, as an example, you might iterate over the books list as follows:

```php
if ( have_rows( 'book', 'books' ) ):
  while ( have_rows( 'book', 'books' ) ): the_row(); 
    $book_title = get_sub_field( 'book_title' ) ?: "":
    $authors = [];
    if ( have_rows( 'authors' ) ):
      while ( have_rows( 'authors') ): the_row();
        if ( have_rows( 'author' ) ):
          while( have_rows( 'author' ) ): the_row();
            $name = get_sub_field( 'name' ) ?: "";
            $url = get_sub_field( 'url' ) ?: "";
            $email = get_sub_field( 'email' ) ?: "";
            $bio = get_sub_field( 'short_bio' ) ?: "";
            $img = get_sub_field( 'profile_image' ) ?: [];
            $authors[] = array(
              "name" => $name,
              "url" => $url,
              "email" => $email,
              "bio" => $bio,
              "img" => $img
            );
          endwhile;
        endif;
      endwhile;
    endif;
    // ... keep accessing fields then do something with data
  endwhile;
endif;
```

## TO DO:

- Add Settings to allow choice between options pages or custom post types.
- Complete the development of Custom Post Type Templates
- Add Support For More Structured Data types referenced by Google: https://developers.google.com/search/reference/overview
- Fill out the complete examples within this README

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/wesleylhandy/books-events-faq-options/tags). 

## Authors

* **Wesley L. Handy** - *Initial work* 

See also the list of [contributors](https://github.com/wesleylhandy/books-events-faq-options/contributors) who participated in this project.

## License

Copyright 2020 Wesley L. Handy

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.