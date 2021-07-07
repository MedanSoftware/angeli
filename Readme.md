# Angeli

Started from [Codeigniter](https://codeigniter.com) for Full-Stack Web Developer to Create Any Flexible and Complex Web Application with Best Performance and Perfect SEO.


## Server Requirements

- SQLite Extension

## Installation

### Install required packages

```bash
bash:~$ git clone https://github.com/MedanSoftware/angeli.git
bash:~$ composer install -d angeli/application/
bash:~$ composer install -d angeli/api/application/
```
### Environment Change

> /api/.htaccess

> /.htaccess

```text
SetEnv CI_ENV development
```
### Activation User Module Theme

```text
{{base_url}}api/themes/activate/user/adminLTE-2

for the preview page, you can look at the http://{{ app_url }}/user
```

### Filemanager Setup

> Config file : assets/plugins/RichFilemanager/config/angeli.json

Change the `connectorUrl` to {{base_url}}/api/filemanager


### Sample of Eloquent Model Class

```php
namespace Angeli\Model;

class User extends Eloquent_Model
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	public $timestamps	= TRUE;

	protected $table	= 'user';
	protected $guarded	= array();
	protected $hidden	= array();
	protected $fillable	= array();
	protected $connection	= ACTIVE_DATABASE_GROUP;
}

```

### Sample of Codeigniter Model Class

```php
namespace Angeli;

class User extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Authentication
	 * 
	 * @param  string $identity
	 * @param  string $password
	 * @return object
	 */
	public function auth($identity = NULL, $password = NULL) {
		$auth = Model\User::where(function($_identity) use ($identity) { 
			return $_identity->where('username', $identity)->orWhere('email', $identity);
		})->where('password', $this->security->set_password($password));

		return $auth;
	}
}

/* End of file User.php */
/* Location : ./application/models/User.php */
```

### Create HMVC Controller

```php
class Site extends MX_Controller
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->template->site('home');
	}

	public function filemanager()
	{
		$this->template->site('filemanager');
	}

	public function sign_in()
	{
		$this->load->model('user'); // Load user model in APPPATH.models/
		$auth = $this->user->auth($this->input->post('username'), $this->input->post('password')); // Call model method
		echo $auth->toSql(); // Print query | Output : select * from `user` where (`username` = ? or `email` = ?) and `password` = ? and `user`.`deleted_at` is null
	}
}

/* End of file Site.php */
/* Location : ./site/controllers/Site.php */
```

### Create RESTful-API Controller

```php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Codeigniter
 * @subpackage User
 * @category RESTful Controller
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

class User extends RESTful_API
{
	/**
	 * constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * REST-API METHODS
	 * ----------------------------------------------------------------------------------------------------
	 */

	public function index_get()
	{
		$this->set_header(RESTful_API::HTTP_OK)->send_response('success', array(
			'name' => 'angeli'
		));
	}

	public function sign_up_post()
	{
		$this->load->model('user'); // Load user model in APPPATH.models/
		$auth = $this->user->auth($this->post('username'), $this->post('password')); // Call model method
		$this->set_header(RESTful_API::HTTP_OK)->send_response('success', $this->post(), $auth->toSql()); // for the output display, let's seet at the RESTful-API Output Sample
	}

	/**
	 * ----------------------------------------------------------------------------------------------------
	 * CALLABLE METHODS
	 * ----------------------------------------------------------------------------------------------------
	 */

	public function test()
	{

	}
}
```

### RESTful-API Output Sample

```json
{
    "status": "success",
    "data": {
        "username": "medansoftware",
        "password": "medansoftware"
    },
    "message": "select * from `user` where (`username` = ? or `email` = ?) and `password` = ? and `user`.`deleted_at` is null"
}
```

## Feature

**HMVC** 
- Angeli already using a HMVC module from [wiredesignz/codeigniter-modular-extensions-hmvc](https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc/src)

**Eloquent ORM**
- You can use Eloquent in angeli project

**Template Engine**
- Angeli already using template engine [Twig](https://twig.symfony.com) & [Blade](https://laravel.com/docs/7.x/blade)

**Dynamic Template**
- You can use or start development some template like a wordpress site

**RESTful-API**
- Angeli have a RESTful API module, library from [chriskacerguis/codeigniter-restserver](https://github.com/chriskacerguis/codeigniter-restserver)

**Multi Languages**
- You can make some website with multi languages and saved in json file

**File Manager**
- This has file manager using [RichFilemanager](https://github.com/psolom/RichFilemanager)

**DataTable Plugin**
- Display tables with [DataTables](https://datatables.net)