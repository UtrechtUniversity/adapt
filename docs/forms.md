# ADAPT forms

## general

Forms are rendered by adapt as configured within a form configuration file. To create or alter a form a JSON formatted 
configuration must be produced. This documentation describes how to change the presented fields, its post processing 
and validation rules. Extra sections are available on how to create new or alter default available options.

## form settings

The form configuration file consists of top level settings that describe the form itself and a list of fields and 
its options. The available top level settings are described in the table below.

| Name | Description |
| --- | --- |
| name | title of the form displayed to users  |
| description | description as displayed to users |
| processor | processor used to process form |

*List of available processors

Sample of a form configuration without fields:

```
{
	"name": "Sample form",
	"description": "This is an empty form!",
	"processor": "excel-download",
	"fields": [
		
	]
}
```

## form fields

Fields are described within the fields section of the configuration file. The order of fields in the configuration 
file determines the order of fields displayed. Each field is configured within a separate JSON element. The available 
options differ per type of field however some settings are available or required for each described form element.

Sample of a form with a text field described within the form configuration:

```
{
	"name": "Sample form",
	"description": "Simple form with single text field",
	"processor": "excel-download",
	"fields": [
		{
			"name": "sampleText",
			"type": "text",
			"label": "title",
			"description": "This is the description of the title field!",
			"rules": []
		}
	]
}
```

Default settings per field

| name | description |
| --- | --- |
| name* | name of the field, not displayed to user. Must be unique |
| type* | type of the field, types are described in the following section |
| rules | validation rules, available options are described in the validation rules section |

_Names marked with * are required_

Available field types
- [text](#single-line-text-field)
- [multiline text](#multiline-text-field)
- [date](#date)
- [select](#select)
- [keywords](#keywords)
- [geo locations](#geo-locations)

### single line text field

available single line text field settings

| name | description |
| --- | --- |
| name* | name of the field, not displayed to user. Must be unique |
| type* | type of the field, types are described in the following section |
| rules | validation rules, available options are described in the validation rules section |
| label | label displayed in front of field |
| description | text displayed below field |

_Names marked with * are required_

Sample configuration:

```
{
    "name": "sample text",
    "type": "text",
    "label": "title",
    "description": "This is the description of the title field!",
    "rules": []
}
```

Screenshot:

### multiline text field

available multi line text field settings

| name | description |
| --- | --- |
| name* | name of the field, not displayed to user. Must be unique |
| type* | type of the field, types are described in the following section |
| rules | validation rules, available options are described in the validation rules section |
| label | label displayed in front of field |
| description | text displayed below field |
| lines | height of field as number of lines (default 3) |

_Names marked with * are required_

Sample configuration:

```
{
    "name": "sample multiline text",
    "type": "multiline-text",
    "label": "multiline text",
    "description": "This is the description of the multiline field!",
    "rules": [],
    "lines": 3
}
```

Screenshot:

### date

available date field settings

| name | description |
| --- | --- |
| name* | name of the field, not displayed to user. Must be unique |
| type* | type of the field, types are described in the following section |
| rules | validation rules, available options are described in the validation rules section |
| label | label displayed in front of field |
| description | text displayed below field |

_Names marked with * are required_

Sample configuration:

```
{
    "name": "sample date",
    "type": "date",
    "label": "date",
    "description": "This is the description of the date field!",
    "rules": []
}
```

Screenshot:

### select

available select field settings

| name | description |
| --- | --- |
| name* | name of the field, not displayed to user. Must be unique |
| type* | type of the field, types are described in the following section |
| rules | validation rules, available options are described in the validation rules section |
| label | label displayed in front of field |
| options* | list of options |

_Names marked with * are required_

Sample configuration:

```
{
    "name": "sample date",
    "type": "date",
    "label": "date",
    "description": "This is the description of the date field!",
    "rules": [],
    "options" [
        "option 1",
        "option 2",
        "option 3"
    ]
}
```

Screenshot:

### keywords

available keyword selection field settings

| name | description |
| --- | --- |
| name* | name of the field, not displayed to user. Must be unique |
| type* | type of the field, types are described in the following section |
| rules | validation rules, available options are described in the validation rules section |
| description | text displayed below field |
| vocabularyLocation* | location of json file containing vocabulary information, see below for more information |
_Names marked with * are required_

This form element requires a location to a specifically formatted JSON file to display the hierarchical vocabulary 
options. This structure consists out top level elements displayed as a folder containing the nested selectable 
options within. 

top level elements:
- text: text displayed for container
- extra:
  - uri: URI of vocabulary
- children: list of child elements

top level elements:
- text: text displayed for container
- extra:
  - uri: URI of term
  - vocab_uri: URI of vocabulary
- children: list of child elements

Sample snippet of JSON:

```
[
    {
        "text": "materials",
        "extra": {
            "uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/"
        },
        "children": [
            {
                "text": "sedimentary rock",
                "extra": {
                    "uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/sedimentary_rock",
                    "vocab_uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/"
                },
                "children": [
                    {
                        "text": "limestone",
                        "extra": {
                            "uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/sedimentary_rock-limestone",
                            "vocab_uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/"
                        },
                        "children": [
                            {
                                "text": "Anstrude limestone",
                                "extra": {
                                    "uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/sedimentary_rock-limestone-anstrude_limestone",
                                    "vocab_uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/"
                                },
                                "children": []
                            },
                            {
                                "text": "Austin limestone",
                                "extra": {
                                    "uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/sedimentary_rock-limestone-austin_limestone",
                                    "vocab_uri": "https:\/\/epos-msl.uu.nl\/voc\/materials\/1.0\/"
                                },
                                "children": []
                            },
                        ]
                    }
                ]
            }
        ]
    }
]
```

Sample configuration:

```
{
    "name": "sampleKeywords",
    "type": "keywords",
    "label": "keywords",
    "rules": [],
    "vocabularyLocation": "tree.json"
}
```

Screenshot:

### geo locations

available geo locations field settings

| name | description |
| --- | --- |
| name* | name of the field, not displayed to user. Must be unique |
| type* | type of the field, types are described in the following section |
| rules | validation rules, available options are described in the validation rules section |
| description | text displayed below field |
| startLocation | coordinates of default center of view |

_Names marked with * are required_

Sample configuration:

Screenshot:

## field grouping

to-do

## validation rules

Within a fields' configuration validation rules may be defined to check the validity of the information using the 
submitted form. This package is build using the Laravel Framework and supports the use of validation rules as 
available within this framework. A complete list of the available options are described within 
[this](https://laravel.com/docs/10.x/validation#available-validation-rules) documentation section.

Samples:

## form processing

When a form has been submitted all input is validated using the defined validation rules per defined field. If not all 
submitted data passes the validation checks the request is redirected back to the form with information about the 
failed checks. This information can be used to inform the user about the changes that need to be made to the input. 
For example when a user has not filled in a required field the user will be returned back to the form when the form 
is submitted.

When the submitted data passes all defined check the data will be processed by the processor described within the form definition. Some basic processors are available but for custom behavior a new processor class has to be written and added to the codebase. More information about adding a new processor can be found in the [extending section](#extending).

Available processors:

| name | description |
| --- | --- |
| excel-download | returns a xlsx file to the user containing the submitted data |
| json-download | returns a xlsx file to the user containing the submitted data |


## extending

### adjusting templating

### add a new field type

### add a new processor
