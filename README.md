# Multilanguage SEO plugin

This plugin allows to create multilanguage meta content for your pages.

It needs Rainlab Translate plugin to work.

## Using the multilanguage SEO component

First you must ensure that the SEO component is attached to the layout.

The component has a configurable property called "append", if you fill it, the content will be appended to all pages titles. For example, if the page title is "Projects" and the append property is "| SiteName", the page title will show "Projects | SiteName".

Then you should create a SEO register for everypage in your theme. You can do it at Settings > CMS > SEO. Fill the title, description, (optional) keywords and (optional) image in each language.

Finally, show the metas in your layout like this:

```
<title>{{ this.page.meta_title }}</title>
<meta name="description" content="{{ this.page.meta_description }}" />
<meta name="keywords" content="{{ this.page.meta_keywords }}" />
<meta name="title" content="{{ this.page.meta_title }}" />

<meta property="og:title" content="{{ this.page.meta_title }}" />
<meta property="og:description" content="{{ this.page.meta_description }}" />
{% if this.page.seo_image %}
<meta property="og:image" content="{{ this.page.seo_image.getPath() }}" />
{% endif %}
```