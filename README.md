# CI4-WordPress
Proof-of-concept integration of WordPress 6.2 inside of CodeIgniter 4

## Beware! Hacks inside!
As stated in the description, this is nothing more than a **Proof of Concept**. This is not meant for production and if you do you should feel bad. WordPress gets imported in a global scope and that might cause havoc inside your code.

## Why?
Because. I thought it would be nice to have an embeded Blog/Knowledge Base inside my website without having to write one from scratch. So why not WordPress?

## How?
Huh, you're still reading?
- So, first of all, you should install WordPress normally nearby your CodeIgniter 4 installation. I decided to put it into a `wordpress` folder alongside `app`, `system` and `public`.
- After the configuration, you might want to configure Nginx or Apache to block anything but the Admin Panel.
- Then, unfortunately you'll have to patch a file inside WordPress: `wp-includes/link-template.php` has a declaration of `site_url` that conflicts with the same method in CodeIgniter. I just wrapped it into a `if (!function_exists('site_url')) {}`, but you might want to find a better solution.
- Put the `app/Libraries/WordPress.php` into your CodeIgniter App.
- Implement it and extend it as you see fit.

## So what if I want to make it actually useful?
Well. This is a non-comprehensive list of what I would do if I had the time (and what I might do):

- Consider a better solution: a `proxy_pass` based solution would be a thousand times better. You just make WordPress return serialized data, you request it locally from a Model and then you process it in CodeIgniter.
- If that's not an option, find a way to wrap WordPress inside a `namespace`, that would make all of this way less hacky.
- After that, surely WordPress and your CodeIgniter will freak out at each other for session/cookie conflicts. So you might want to fix that.
- Clearly you might need more than just fetching posts, so... that's that.
- Sharing the login session might be cool and actually work out fine, WordPress is actually fairly flexible