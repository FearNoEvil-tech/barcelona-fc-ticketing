# FC Barcelona Ticketing System (IS 6465, Group 4)

Mid-term project, **CODING** phase: the Home page, the Login page, and two CRUD sets
(User Management and Match Management), coded in HTML/CSS with Bootstrap 5.3 and saved as PHP pages.

This is a front-end prototype. There is no database yet: pages show sample data from
`includes/init.php`, and forms return to the next page from the wireframes with a success message.
Each place where the final project will run SQL is marked with a `Final project:` comment.

## Run it

In a Codespace (or any computer with PHP 8):

```bash
php -S 0.0.0.0:8000
```

Then open port 8000 and start at `index.php`.

**Demo login:** any username with a password of at least 8 characters signs in as a fan.
Use the username `admin` (any 8+ character password) to see the administrator pages.
A shorter password shows the "Invalid username/email or password" message.

## Pages

| Wireframe | Page | Use case | Who |
|---|---|---|---|
| WF01 Home | `index.php` | Home (upcoming matches) | Everyone |
| WF02 Login | `login.php` | Sign in | Everyone |
| WF03 Create User Account | `create-user.php` | UC 01 Create User Account | Fan (Register Here) or admin (`?from=admin`) |
| WF04 My Account | `my-account.php` | UC 02 View User Account, UC 04 Delete (button + confirmation) | Fan |
| WF04A Manage Users | `manage-users.php` | UC 02 View, UC 04 Delete (Edit and Delete per row) | Admin |
| WF05 Update User Account | `update-user.php?user_id=1` | UC 03 Update User Account | Fan or admin (`&from=admin`) |
| WF06 Create Match | `create-match.php` | UC 05 Create Match | Admin |
| WF07 View Matches | `matches.php` | UC 06 View Match | Everyone |
| WF07A Manage Matches | `manage-matches.php` | UC 06 View, UC 08 Delete (Edit and Delete per row) | Admin |
| WF08 Update Match | `update-match.php?match_id=1` | UC 07 Update Match | Admin |
| | `logout.php` | Ends the session, returns to Home | Signed in |

## Navigation (from the wireframes)

- **Login:** a fan goes to Home; an admin goes to Manage Matches. Register Here opens Create User Account.
- **Create User Account:** Create Account goes to Login (an admin returns to Manage Users). Cancel goes back without saving.
- **Update User Account:** a fan returns to My Account; an admin returns to Manage Users. Cancel saves nothing.
- **Delete:** every Delete opens a confirmation prompt. Cancel Delete stays on the page; Confirm Delete
  returns to the updated list (deleting your own account signs you out and returns to Login).
- **Create Match / Update Match:** both return to Manage Matches. Cancel saves nothing.
- The navigation bar changes with the role: guest (Home, Matches, Login), fan (adds My Account, Logout),
  admin (adds Manage Users, Manage Matches, Logout).

## Files

```
index.php, login.php, logout.php            Home, Login, Logout
create-user.php, my-account.php,
manage-users.php, update-user.php           User Management CRUD (UC 01-04)
create-match.php, matches.php,
manage-matches.php, update-match.php        Match Management CRUD (UC 05-08)
includes/init.php          time zone, session, helper functions, sample data
includes/header.php        <head>, Bootstrap, stylesheet, navigation
includes/nav.php           role-based navigation bar
includes/footer.php        footer and Bootstrap JavaScript
includes/messages.php      success messages (?msg=...) from an allow-list
includes/delete-modal.php  shared delete confirmation prompt
includes/match-table.php   match list used by Matches and Manage Matches
includes/match-form.php    fields shared by Create Match and Update Match
css/styles.css             club colors and layout
js/app.js                  fills the delete prompt with the selected record
```

## Notes

- Forms use POST and then redirect (Post/Redirect/Get), so refreshing a page never resubmits a form.
  Delete is a POST from the confirmation prompt, never a GET link.
- All values printed in HTML go through `e()` (`htmlspecialchars`), and record IDs in URLs are read with
  `filter_input(..., FILTER_VALIDATE_INT)`.
- Browser checks (required fields, email format, 8-character password, date not in the past, League or Cup)
  are in place. The matching server checks will be added with the database in the final project.
