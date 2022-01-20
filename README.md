# sheets2api Library
Turn Google Sheets to JSON API and excel files

## Fast Links

- [Introduction](#Introduction)
- [Installation](#Installation)
- [Usage](#Usage)

### Introduction

sheets2api Library has been made by [Holoola-z](https://holoola-z.com/) Company, please do not edit or abuse the usage of this Library.

sheets2api Library is mainly used to convert Google Sheets to JSON API so that it can be used in CMS, wordpress, custom websites and more..., You can simply display a Google Spreadsheet in a webpage as json file.

### Installation

The best way to install this Library is through composer:

``` composer require holoolaz/sheets2api ```

### Usage

In your file inlude the ```vendor/autoload.php``` file and use the namespace of the main class like this:

```
require_once 'vendor/autoload.php';

use GoogleSheets2API\Sheets2API\Sheets2API;

$sheets2api = new Sheets2API('YOUR_API_ID_HERE');
```

Let's use our api id '617989cb51352':

```$sheets2api = new Sheets2API('617989cb51352');```

#### Get All Spreadsheet Data

***Important:*** Each time you use this api without using **Spreadsheet()** then you're actually selecting the first sheet like the example below:

```$response = $sheets2api->Spreadsheet()->get();   // Here you're getting all data from first spreadsheet```

***Important:*** Now let's select a specific **Sheet** to get data from:

```$response = $sheets2api->Sheet('Sheet1')->get();   // Here you're getting all data from first spreadsheet```

***Optional Parameters***

```
$params = [
	'limit' => 2,
	'orderBy' => 'Id',
	'order' => 'DESC'
];

$response = $sheets2api->Sheet('Sheet1')->get($params);
print_r($response);
```
Or
```
$params = [
	'limit' => 2,
	'orderBy' => 'Id',
	'order' => 'DESC'
];

$response = $sheets2api->Spreadsheet()->get($params);
print_r($response);
```

***Note:*** Same thing goes to all other api call class methods.

#### Get Spreadsheet Cells

```
$response = $sheets2api->Spreadsheet()->cells('A1,B1');

$response = $sheets2api->Sheet('Sheet1')->cells('A1,B1');   
```

#### Get Spreadsheet Rows Count

```
$response = $sheets2api->Spreadsheet()->count();

$response = $sheets2api->Sheet('Sheet1')->count();   
```

#### Get Spreadsheet Column Names (Keys)

```
$response = $sheets2api->Spreadsheet()->keys(); 

$response = $sheets2api->Sheet('Sheet1')->keys();   
```

#### Search Entire Spreadsheet by Values

```
$query = ['ranger', 'brad'];
$params = [
	'limit' => 3,
	'orderBy' => 'Id',
	'order' => 'DESC',
	'caseSensitive' => 'true'
];

$response = $sheets2api->Spreadsheet()->search($query);

$response = $sheets2api->Sheet('Sheet1')->search($query);   
```

***Note***

This method can take additional parameters:

- limit
- offset
- orderBy
- order
- caseSensitive // This parameter is of type string so be sure to use quotation like: caseSensitive => 'true' // can take (true/false)
- and more...

#### Search Entire Spreadsheet by Condition

```
$query = ['Name' => 'brad']

$response = $sheets2api->Spreadsheet()->searchBy($query);

$response = $sheets2api->Sheet('Sheet1')->searchBy($query); 
```

***Note***

This method can take additional parameters:

- limit
- offset
- orderBy
- order
- caseSensitive
- and more...

#### List Spreadsheet Sheets (Tabs)

```
$response = $sheets2api->Spreadsheet()->sheets();
```

#### Get Spreadsheet Name

```
$response = $sheets2api->Spreadsheet()->name();
```

#### List All Spreadsheets

```
$response = $sheets2api->Spreadsheet()->list();
```

#### Clear Spreadsheet Sheet (Tab)

```
$response = $sheets2api->Sheet('Sheet3')->clear();
```

#### Clear Spreadsheet Sheet (Tab)

```
$response = $sheets2api->Sheet('Sheet3')->copy('SPREADSHEET_ID_TO_COPY_DATA_TO');
$response = $sheets2api->Sheet('Sheet3')->copy('1t59SEiPQtySWFwwBEzP5jcgmX18Ywc5ytYiitJYxbY8');
```

Here we're copying ```Sheet3``` data to this ```1t59SEiPQtySWFwwBEzP5jcgmX18Ywc5ytYiitJYxbY8``` Spreadsheet id.

#### Delete Spreadsheet Row

```
$response = $sheets2api->Sheet('Sheet3')->deleteRow('Id=3');
```
Here we removed the row that has column name **Id** and value of **3**.

***Note:*** Calling this method can delete multiple rows at once, make sure that column name and value are unique.

***Important:*** Do not use spaces in the condition parameter like ```Id = 3``` this won't work.

#### Update Spreadsheet Row

```
$data = ['6', 'john', 'john@yahoo.com', 'Slovakia'];
$response = $sheets2api->Spreadsheet()->addRow($data);
$response = $sheets2api->Sheet('Sheet3')->addRow($data);
```

#### Update Spreadsheet Multiple Rows

```
$data = [
	array('6', 'john', 'john@yahoo.com', 'Slovakia'),
	array('7', 'jack', 'jack@gmail.com', 'Brazil')
];
$response = $sheets2api->Spreadsheet()->addRows($data);
$response = $sheets2api->Sheet('Sheet3')->addRows($data);
```

#### Create Spreadsheet Sheet (Tab)

```
$response = $sheets2api->SpreadSheet()->create('NEW_SHEET');
```

**Note**: Here we created a new **Sheet** called **NEW_SHEET**.

#### Delete Spreadsheet Sheets (Tabs)

```
$sheets = ['Sheet23'];
$response = $sheets2api->SpreadSheet()->deleteSheets($sheets);
```

**Note**: Here we're deleting only **Sheet23**, but what if we wanted to delete 3 more sheets.

```
$sheets = ['Sheet23', 'Sheet24', 'Sheet25'];
$response = $sheets2api->SpreadSheet()->deleteSheets($sheets);
```

That's it, we deleted 3 **Sheets** instead of 1.

#### Import HTML Table into Sheet (TAB)

```
$url = 'URL_TO_IMPORT_FROM';
$index = 1;

$response = $sheets2api->Sheet('Sheet26')->importTable($url, $index);
```

#### Import HTML List into Sheet (TAB)

```
$url = 'URL_TO_IMPORT_FROM';
$index = 1;

$response = $sheets2api->Sheet('Sheet26')->importList($url, $index);
```


**Important:** You can always use [Our API Documentation](https://sheets2api.com/docs) for more step by step guide.
