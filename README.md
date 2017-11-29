# Hackable

**WARNING: do not use this website in prod!**

This is the source code of a willingly flawed website that can be hacked. You can only find this website in an private network.

The challenge is to find the token on the admin web page. This is a challenge for **[@CPLN](https://github.com/CPLN)** users only. You can use this code on your own web server if you want to create your own challenge.

## Notes

The values for the user/pass you can find in `db.txt`, the token in `admin.php` and the `SECRET` constant in `config.php` are not the same on the online website. The rest is 100% identical. Use the source code to find the flaws.

## Requirements

- Apache + `mod_php` + `mod_rewrite`
- PHP 7+ with GD
- Disable the `NOTICE`

## Installation

```
$ chmod a+w data/logs.txt
```
