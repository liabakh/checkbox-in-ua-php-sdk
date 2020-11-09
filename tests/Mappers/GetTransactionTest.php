<?php

declare(strict_types=1);

namespace igorbunov\Checkbox\Mappers;

use igorbunov\Checkbox\Mappers\Transactions\TransactionMapper;
use PHPUnit\Framework\TestCase;

class GetTransactionTest extends TestCase
{
    /** @var  string $jsonString */
    private $jsonString;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->jsonString = '{
           "id":"c301b216-10eb-4b0e-b21a-47dab1b56a64",
           "type":"SHIFT_OPEN",
           "serial":0,
           "status":"DONE",
           "request_signed_at":"2020-10-05T10:53:12.259694+00:00",
           "request_received_at":"2020-10-05T10:53:13.315504+00:00",
           "response_status":"OK",
           "response_error_message":null,
           "created_at":"2020-10-05T10:14:36.171086+00:00",
           "updated_at":"2020-10-05T10:53:15.166567+00:00",
           "request_data":"PFJRIFY9IjEiPjxEQVQgRk49IjQwMDAwMzczNjciIFROPSImIzEwNTU7JiMxMDUzOyAiIFpOPSIzRTY1MEYzR' .
                'TA5Qjk0NEU0QkFFQUY0MEYxNDNDQkIwMCIgREk9IjAiIERUPSIwIiBWPSIxIj48QyBUPSI4IiAvPjxUUz4yMDIwMTAwNTEzM' .
                'TQzNjwvVFM+PC9EQVQ+PE1BQyAvPjwvUlE+",
           "request_signature":"MIIOmAYJKoZIhvcNAQcCoIIOiTCCDoUCAQExDjAMBgoqhiQCAQEBAQIBMIGzBgkqhkiG9w0BBwGggaUE' .
            'gaI8UlEgVj0iMSI+PERBVCBGTj0iNDAwMDAzNzM2NyIgVE49IiYjMTA1NTsmIzEwNTM7ICIgWk49IjNFNjUwRjNFMDlCOTQ0RTRCQ' .
            'UVBRjQwRjE0M0NCQjAwIiBEST0iMCIgRFQ9IjAiIFY9IjEiPjxDIFQ9IjgiIC8+PFRTPjIwMjAxMDA1MTMxNDM2PC9UUz48L0RBVD4' .
            '8TUFDIC8+PC9SUT6gggYVMIIGETCCBbmgAwIBAgIUWOLZ5/kAMHsEAAAARwUwAM/JiAAwDQYLKoYkAgEBAQEDAQEwggEWMVQwUg' .
            'YDVQQKDEvQhtC90YTQvtGA0LzQsNGG0ZbQudC90L4t0LTQvtCy0ZbQtNC60L7QstC40Lkg0LTQtdC/0LDRgNGC0LDQvNC10L3Rgi' .
            'DQlNCf0KExXjBcBgNVBAsMVdCj0L/RgNCw0LLQu9GW0L3QvdGPICjRhtC10L3RgtGAKSDRgdC10YDRgtC40YTRltC60LDRhtGW0Zcg' .
            '0LrQu9GO0YfRltCyINCG0JTQlCDQlNCf0KExIzAhBgNVBAMMGtCa0J3QldCU0J8gLSDQhtCU0JQg0JTQn9ChMRkwFwYDVQQFDBBV' .
            'QS00MzE3NDcxMS0yMDE5MQswCQYDVQQGEwJVQTERMA8GA1UEBwwI0JrQuNGX0LIwHhcNMjAwOTI4MDc1NDI3WhcNMjIwOTI4MDc1ND' .
            'I3WjCByTFQME4GA1UECgxH0J/RgNC40LLQsNGC0L3QtSDQsNC60YbRltC+0L3QtdGA0L3QtSDRgtC+0LLQsNGA0LjRgdGC0LLQviA' .
            'i0JvRltGC0LDQuiIxIjAgBgNVBAMMGdCU0LvRjyDQoNCg0J4g4oSWIDM0NTM0MjUxEDAOBgNVBAUTBzMxNDcwNzkxCzAJBgNVBAYT' .
            'AlVBMRUwEwYDVQQHDAzQltCw0YjQutGW0LIxGzAZBgNVBAgMEtCn0LXRgNC60LDRgdGM0LrQsDCB8jCByQYLKoYkAgEBAQEDAQEwgb' .
            'kwdTAHAgIBAQIBDAIBAAQhEL7j22rqnh+GV4xFwSWU/5QjlKfXOPkYfmUVAXKU9M4BAiEAgAAAAAAAAAAAAAAAAAAAAGdZITrxgum' .
            'H0+F3FJB9Rw0EIbYP0tjc6Kk0I8YQG8qRxHoAfmwwCybNVWybDn0g7ykqAARAqdbrRfE8cIKAxJZ7Ix9erfZY66TANykdONlr8CXK' .
            'Thf46XINxhW0OiiXXwvB3qNkOLVk6iwXn9ASPm24+sV5BAMkAAQhw672tykX+3XmME+GbkxM8KpaPjKpGxzAs/G8oOoB9LUAo4ICk' .
            'DCCAowwKQYDVR0OBCIEIPjU2aOUaZxEYWqNhCUPLNwIMxAH2RX2UuQ2uU4GdkPtMCsGA1UdIwQkMCKAINji2ef5ADB7OPJyiLQF' .
            'Asens/5lUpDoScKR0GSnM4xcMA4GA1UdDwEB/wQEAwIGwDAUBgNVHSUEDTALBgkqhiQCAQEBAwkwFgYDVR0gBA8wDTALBgkqhiQC' .
            'AQEBAgIwCQYDVR0TBAIwADAbBggrBgEFBQcBAwQPMA0wCwYJKoYkAgEBAQIBMB4GA1UdEQQXMBWgEwYKKwYBBAGCNxQCA6AFDAM5' .
            'OTgwSQYDVR0fBEIwQDA+oDygOoY4aHR0cDovL2Fjc2tpZGQuZ292LnVhL2Rvd25sb2FkL2NybHMvQ0EtMjBCNEU0RUQtRnVsbC5j' .
            'cmwwSgYDVR0uBEMwQTA/oD2gO4Y5aHR0cDovL2Fjc2tpZGQuZ292LnVhL2Rvd25sb2FkL2NybHMvQ0EtMjBCNEU0RUQtRGVsdGEu' .
            'Y3JsMIGOBggrBgEFBQcBAQSBgTB/MDAGCCsGAQUFBzABhiRodHRwOi8vYWNza2lkZC5nb3YudWEvc2VydmljZXMvb2NzcC8wSwYI' .
            'KwYBBQUHMAKGP2h0dHA6Ly9hY3NraWRkLmdvdi51YS9kb3dubG9hZC9jZXJ0aWZpY2F0ZXMvYWxsYWNza2lkZC0yMDE4LnA3YjA/' .
            'BggrBgEFBQcBCwQzMDEwLwYIKwYBBQUHMAOGI2h0dHA6Ly9hY3NraWRkLmdvdi51YS9zZXJ2aWNlcy90c3AvMEMGA1UdCQQ8MDow' .
            'GgYMKoYkAgEBAQsBBAIBMQoTCDM0NTU0MzU1MBwGDCqGJAIBAQELAQQHATEMEwoyMTEzMzU3NzQ0MA0GCyqGJAIBAQEBAwEBA0MA' .
            'BEDZENHUlhBfgipZMGz26QymLKw95ZrNSkCh3xutEuTGQhVlooexSDupJD2UnZTXMpCQG2d+TICopxaZ+Y7saWcKMYIHnzCCB5sC' .
            'AQEwggEwMIIBFjFUMFIGA1UECgxL0IbQvdGE0L7RgNC80LDRhtGW0LnQvdC+LdC00L7QstGW0LTQutC+0LLQuNC5INC00LXQv9Cw' .
            '0YDRgtCw0LzQtdC90YIg0JTQn9ChMV4wXAYDVQQLDFXQo9C/0YDQsNCy0LvRltC90L3RjyAo0YbQtdC90YLRgCkg0YHQtdGA0YLQ' .
            'uNGE0ZbQutCw0YbRltGXINC60LvRjtGH0ZbQsiDQhtCU0JQg0JTQn9ChMSMwIQYDVQQDDBrQmtCd0JXQlNCfIC0g0IbQlNCUINCU' .
            '0J/QoTEZMBcGA1UEBQwQVUEtNDMxNzQ3MTEtMjAxOTELMAkGA1UEBhMCVUExETAPBgNVBAcMCNCa0LjRl9CyAhRY4tnn+QAwewQA' .
            'AABHBTAAz8mIADAMBgoqhiQCAQEBAQIBoIIGATAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0yMDEw' .
            'MDUxMDUzMTJaMC8GCSqGSIb3DQEJBDEiBCCKS2Lo1SqwB+RmTyG8ZQ0Fr1KrHNEapoJtKGGTu8+9XTCCAYkGCyqGSIb3DQEJEAIv' .
            'MYIBeDCCAXQwggFwMIIBbDAMBgoqhiQCAQEBAQIBBCDIIlQZ0IE4YkJ1LR4BofVjMLQu/mBr1k1KElUg+x2iXTCCATgwggEepIIB' .
            'GjCCARYxVDBSBgNVBAoMS9CG0L3RhNC+0YDQvNCw0YbRltC50L3Qvi3QtNC+0LLRltC00LrQvtCy0LjQuSDQtNC10L/QsNGA0YLQ' .
            'sNC80LXQvdGCINCU0J/QoTFeMFwGA1UECwxV0KPQv9GA0LDQstC70ZbQvdC90Y8gKNGG0LXQvdGC0YApINGB0LXRgNGC0LjRhNGW' .
            '0LrQsNGG0ZbRlyDQutC70Y7Rh9GW0LIg0IbQlNCUINCU0J/QoTEjMCEGA1UEAwwa0JrQndCV0JTQnyAtINCG0JTQlCDQlNCf0KEx' .
            'GTAXBgNVBAUMEFVBLTQzMTc0NzExLTIwMTkxCzAJBgNVBAYTAlVBMREwDwYDVQQHDAjQmtC40ZfQsgIUWOLZ5/kAMHsEAAAARwUw' .
            'AM/JiAAwggQHBgsqhkiG9w0BCRACFDGCA/YwggPyBgkqhkiG9w0BBwKgggPjMIID3wIBAzEOMAwGCiqGJAIBAQEBAgEwawYLKoZI' .
            'hvcNAQkQAQSgXARaMFgCAQEGCiqGJAIBAQECAwEwMDAMBgoqhiQCAQEBAQIBBCCKS2Lo1SqwB+RmTyG8ZQ0Fr1KrHNEapoJtKGGT' .
            'u8+9XQIEBAj1xhgPMjAyMDEwMDUxMDUzMTFaMYIDWzCCA1cCAQEwggETMIH6MT8wPQYDVQQKDDbQnNGW0L3RltGB0YLQtdGA0YHR' .
            'gtCy0L4g0Y7RgdGC0LjRhtGW0Zcg0KPQutGA0LDRl9C90LgxMTAvBgNVBAsMKNCQ0LTQvNGW0L3RltGB0YLRgNCw0YLQvtGAINCG' .
            '0KLQoSDQptCX0J4xSTBHBgNVBAMMQNCm0LXQvdGC0YDQsNC70YzQvdC40Lkg0LfQsNGB0LLRltC00YfRg9Cy0LDQu9GM0L3QuNC5' .
            'INC+0YDQs9Cw0L0xGTAXBgNVBAUMEFVBLTAwMDE1NjIyLTIwMTcxCzAJBgNVBAYTAlVBMREwDwYDVQQHDAjQmtC40ZfQsgIUPbc+' .
            'e/DVdbICAAAAAQAAALsAAAAwDAYKKoYkAgEBAQECAaCCAdowGgYJKoZIhvcNAQkDMQ0GCyqGSIb3DQEJEAEEMBwGCSqGSIb3DQEJ' .
            'BTEPFw0yMDEwMDUxMDUzMTFaMC8GCSqGSIb3DQEJBDEiBCB3F89xZcWZ8AZrjnYEeDfd/azANFp2Wesf5/4a6CgepTCCAWsGCyqG' .
            'SIb3DQEJEAIvMYIBWjCCAVYwggFSMIIBTjAMBgoqhiQCAQEBAQIBBCCvFkzYZwHl2QbqJ6FEnK6D7xaNYeLqR5QH2W9lpSzhPTCC' .
            'ARowggEApIH9MIH6MT8wPQYDVQQKDDbQnNGW0L3RltGB0YLQtdGA0YHRgtCy0L4g0Y7RgdGC0LjRhtGW0Zcg0KPQutGA0LDRl9C9' .
            '0LgxMTAvBgNVBAsMKNCQ0LTQvNGW0L3RltGB0YLRgNCw0YLQvtGAINCG0KLQoSDQptCX0J4xSTBHBgNVBAMMQNCm0LXQvdGC0YDQ' .
            'sNC70YzQvdC40Lkg0LfQsNGB0LLRltC00YfRg9Cy0LDQu9GM0L3QuNC5INC+0YDQs9Cw0L0xGTAXBgNVBAUMEFVBLTAwMDE1NjIy' .
            'LTIwMTcxCzAJBgNVBAYTAlVBMREwDwYDVQQHDAjQmtC40ZfQsgIUPbc+e/DVdbICAAAAAQAAALsAAAAwDQYLKoYkAgEBAQEDAQEE' .
            'QIvIyn+cLBBdRM5wUVGhejzbZo5i9wGW1J7Y4vQC6AFVRj9FgLQmwqkVmCSZZBfKudhmVfVeP2LTXc83LY87+UUwDQYLKoYkAgEB' .
            'AQEDAQEEQJQW+G36erYzuG2dgtE31RdGB1ZAMJDvSkHfsbhacxZkVgcgHF30G4G/GBljI980WpgM8Yj/SuDuPYdT9OzIUC0=",
           "response_id":"VmwO1eke6BM",
           "response_data_signature":null,
           "response_data":null
        }';
    }

    public function testMapShiftWithNull(): void
    {
        $this->assertNull(
            (new TransactionMapper())->jsonToObject(null)
        );
    }

    public function testMapGetShiftWithJson(): void
    {
        $jsonResponse = json_decode($this->jsonString, true);

        $mapped = (new TransactionMapper())->jsonToObject($jsonResponse);

        $this->assertEquals(
            'c301b216-10eb-4b0e-b21a-47dab1b56a64',
            $mapped->id
        );
        $this->assertEquals(
            'PFJRIFY9IjEiPjxEQVQgRk49IjQwMDAwMzczNjciIFROPSImIzEwNTU7JiMxMDUzOyAiIFpOPSIzRTY1MEYzRTA5Q' .
            'jk0NEU0QkFFQUY0MEYxNDNDQkIwMCIgREk9IjAiIERUPSIwIiBWPSIxIj48QyBUPSI4IiAvPjxUUz4yMDIwMTAwNTEzMTQzNjwv' .
            'VFM+PC9EQVQ+PE1BQyAvPjwvUlE+',
            $mapped->request_data
        );
        $this->assertEquals(
            'MIIOmAYJKoZIhvcNAQcCoIIOiTCCDoUCAQExDjAMBgoqhiQCAQEBAQIBMIGzBgkqhkiG9w0BBwGggaUEgaI8UlEgVj' .
            '0iMSI+PERBVCBGTj0iNDAwMDAzNzM2NyIgVE49IiYjMTA1NTsmIzEwNTM7ICIgWk49IjNFNjUwRjNFMDlCOTQ0RTRCQUVBRjQwR' .
            'jE0M0NCQjAwIiBEST0iMCIgRFQ9IjAiIFY9IjEiPjxDIFQ9IjgiIC8+PFRTPjIwMjAxMDA1MTMxNDM2PC9UUz48L0RBVD48TUFD' .
            'IC8+PC9SUT6gggYVMIIGETCCBbmgAwIBAgIUWOLZ5/kAMHsEAAAARwUwAM/JiAAwDQYLKoYkAgEBAQEDAQEwggEWMVQwUgYDVQQK' .
            'DEvQhtC90YTQvtGA0LzQsNGG0ZbQudC90L4t0LTQvtCy0ZbQtNC60L7QstC40Lkg0LTQtdC/0LDRgNGC0LDQvNC10L3RgiDQlNCf' .
            '0KExXjBcBgNVBAsMVdCj0L/RgNCw0LLQu9GW0L3QvdGPICjRhtC10L3RgtGAKSDRgdC10YDRgtC40YTRltC60LDRhtGW0Zcg0LrQ' .
            'u9GO0YfRltCyINCG0JTQlCDQlNCf0KExIzAhBgNVBAMMGtCa0J3QldCU0J8gLSDQhtCU0JQg0JTQn9ChMRkwFwYDVQQFDBBVQS0' .
            '0MzE3NDcxMS0yMDE5MQswCQYDVQQGEwJVQTERMA8GA1UEBwwI0JrQuNGX0LIwHhcNMjAwOTI4MDc1NDI3WhcNMjIwOTI4MDc1ND' .
            'I3WjCByTFQME4GA1UECgxH0J/RgNC40LLQsNGC0L3QtSDQsNC60YbRltC+0L3QtdGA0L3QtSDRgtC+0LLQsNGA0LjRgdGC0LLQv' .
            'iAi0JvRltGC0LDQuiIxIjAgBgNVBAMMGdCU0LvRjyDQoNCg0J4g4oSWIDM0NTM0MjUxEDAOBgNVBAUTBzMxNDcwNzkxCzAJBgNV' .
            'BAYTAlVBMRUwEwYDVQQHDAzQltCw0YjQutGW0LIxGzAZBgNVBAgMEtCn0LXRgNC60LDRgdGM0LrQsDCB8jCByQYLKoYkAgEBAQE' .
            'DAQEwgbkwdTAHAgIBAQIBDAIBAAQhEL7j22rqnh+GV4xFwSWU/5QjlKfXOPkYfmUVAXKU9M4BAiEAgAAAAAAAAAAAAAAAAAAAAGd' .
            'ZITrxgumH0+F3FJB9Rw0EIbYP0tjc6Kk0I8YQG8qRxHoAfmwwCybNVWybDn0g7ykqAARAqdbrRfE8cIKAxJZ7Ix9erfZY66TANyk' .
            'dONlr8CXKThf46XINxhW0OiiXXwvB3qNkOLVk6iwXn9ASPm24+sV5BAMkAAQhw672tykX+3XmME+GbkxM8KpaPjKpGxzAs/G8oOo' .
            'B9LUAo4ICkDCCAowwKQYDVR0OBCIEIPjU2aOUaZxEYWqNhCUPLNwIMxAH2RX2UuQ2uU4GdkPtMCsGA1UdIwQkMCKAINji2ef5ADB' .
            '7OPJyiLQFAsens/5lUpDoScKR0GSnM4xcMA4GA1UdDwEB/wQEAwIGwDAUBgNVHSUEDTALBgkqhiQCAQEBAwkwFgYDVR0gBA8wDTAL' .
            'BgkqhiQCAQEBAgIwCQYDVR0TBAIwADAbBggrBgEFBQcBAwQPMA0wCwYJKoYkAgEBAQIBMB4GA1UdEQQXMBWgEwYKKwYBBAGCNxQCA' .
            '6AFDAM5OTgwSQYDVR0fBEIwQDA+oDygOoY4aHR0cDovL2Fjc2tpZGQuZ292LnVhL2Rvd25sb2FkL2NybHMvQ0EtMjBCNEU0RUQtRn' .
            'VsbC5jcmwwSgYDVR0uBEMwQTA/oD2gO4Y5aHR0cDovL2Fjc2tpZGQuZ292LnVhL2Rvd25sb2FkL2NybHMvQ0EtMjBCNEU0RUQtRG' .
            'VsdGEuY3JsMIGOBggrBgEFBQcBAQSBgTB/MDAGCCsGAQUFBzABhiRodHRwOi8vYWNza2lkZC5nb3YudWEvc2VydmljZXMvb2NzcC' .
            '8wSwYIKwYBBQUHMAKGP2h0dHA6Ly9hY3NraWRkLmdvdi51YS9kb3dubG9hZC9jZXJ0aWZpY2F0ZXMvYWxsYWNza2lkZC0yMDE4Ln' .
            'A3YjA/BggrBgEFBQcBCwQzMDEwLwYIKwYBBQUHMAOGI2h0dHA6Ly9hY3NraWRkLmdvdi51YS9zZXJ2aWNlcy90c3AvMEMGA1UdCQ' .
            'Q8MDowGgYMKoYkAgEBAQsBBAIBMQoTCDM0NTU0MzU1MBwGDCqGJAIBAQELAQQHATEMEwoyMTEzMzU3NzQ0MA0GCyqGJAIBAQEBAw' .
            'EBA0MABEDZENHUlhBfgipZMGz26QymLKw95ZrNSkCh3xutEuTGQhVlooexSDupJD2UnZTXMpCQG2d+TICopxaZ+Y7saWcKMYIHnz' .
            'CCB5sCAQEwggEwMIIBFjFUMFIGA1UECgxL0IbQvdGE0L7RgNC80LDRhtGW0LnQvdC+LdC00L7QstGW0LTQutC+0LLQuNC5INC00L' .
            'XQv9Cw0YDRgtCw0LzQtdC90YIg0JTQn9ChMV4wXAYDVQQLDFXQo9C/0YDQsNCy0LvRltC90L3RjyAo0YbQtdC90YLRgCkg0YHQtd' .
            'GA0YLQuNGE0ZbQutCw0YbRltGXINC60LvRjtGH0ZbQsiDQhtCU0JQg0JTQn9ChMSMwIQYDVQQDDBrQmtCd0JXQlNCfIC0g0IbQlN' .
            'CUINCU0J/QoTEZMBcGA1UEBQwQVUEtNDMxNzQ3MTEtMjAxOTELMAkGA1UEBhMCVUExETAPBgNVBAcMCNCa0LjRl9CyAhRY4tnn+Q' .
            'AwewQAAABHBTAAz8mIADAMBgoqhiQCAQEBAQIBoIIGATAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw' .
            '0yMDEwMDUxMDUzMTJaMC8GCSqGSIb3DQEJBDEiBCCKS2Lo1SqwB+RmTyG8ZQ0Fr1KrHNEapoJtKGGTu8+9XTCCAYkGCyqGSIb3DQ' .
            'EJEAIvMYIBeDCCAXQwggFwMIIBbDAMBgoqhiQCAQEBAQIBBCDIIlQZ0IE4YkJ1LR4BofVjMLQu/mBr1k1KElUg+x2iXTCCATgwgg' .
            'EepIIBGjCCARYxVDBSBgNVBAoMS9CG0L3RhNC+0YDQvNCw0YbRltC50L3Qvi3QtNC+0LLRltC00LrQvtCy0LjQuSDQtNC10L/QsN' .
            'GA0YLQsNC80LXQvdGCINCU0J/QoTFeMFwGA1UECwxV0KPQv9GA0LDQstC70ZbQvdC90Y8gKNGG0LXQvdGC0YApINGB0LXRgNGC0L' .
            'jRhNGW0LrQsNGG0ZbRlyDQutC70Y7Rh9GW0LIg0IbQlNCUINCU0J/QoTEjMCEGA1UEAwwa0JrQndCV0JTQnyAtINCG0JTQlCDQlN' .
            'Cf0KExGTAXBgNVBAUMEFVBLTQzMTc0NzExLTIwMTkxCzAJBgNVBAYTAlVBMREwDwYDVQQHDAjQmtC40ZfQsgIUWOLZ5/kAMHsEAA' .
            'AARwUwAM/JiAAwggQHBgsqhkiG9w0BCRACFDGCA/YwggPyBgkqhkiG9w0BBwKgggPjMIID3wIBAzEOMAwGCiqGJAIBAQEBAgEwaw' .
            'YLKoZIhvcNAQkQAQSgXARaMFgCAQEGCiqGJAIBAQECAwEwMDAMBgoqhiQCAQEBAQIBBCCKS2Lo1SqwB+RmTyG8ZQ0Fr1KrHNEapo' .
            'JtKGGTu8+9XQIEBAj1xhgPMjAyMDEwMDUxMDUzMTFaMYIDWzCCA1cCAQEwggETMIH6MT8wPQYDVQQKDDbQnNGW0L3RltGB0YLQtd' .
            'GA0YHRgtCy0L4g0Y7RgdGC0LjRhtGW0Zcg0KPQutGA0LDRl9C90LgxMTAvBgNVBAsMKNCQ0LTQvNGW0L3RltGB0YLRgNCw0YLQvt' .
            'GAINCG0KLQoSDQptCX0J4xSTBHBgNVBAMMQNCm0LXQvdGC0YDQsNC70YzQvdC40Lkg0LfQsNGB0LLRltC00YfRg9Cy0LDQu9GM0L' .
            '3QuNC5INC+0YDQs9Cw0L0xGTAXBgNVBAUMEFVBLTAwMDE1NjIyLTIwMTcxCzAJBgNVBAYTAlVBMREwDwYDVQQHDAjQmtC40ZfQsg' .
            'IUPbc+e/DVdbICAAAAAQAAALsAAAAwDAYKKoYkAgEBAQECAaCCAdowGgYJKoZIhvcNAQkDMQ0GCyqGSIb3DQEJEAEEMBwGCSqGSI' .
            'b3DQEJBTEPFw0yMDEwMDUxMDUzMTFaMC8GCSqGSIb3DQEJBDEiBCB3F89xZcWZ8AZrjnYEeDfd/azANFp2Wesf5/4a6CgepTCCAW' .
            'sGCyqGSIb3DQEJEAIvMYIBWjCCAVYwggFSMIIBTjAMBgoqhiQCAQEBAQIBBCCvFkzYZwHl2QbqJ6FEnK6D7xaNYeLqR5QH2W9lpS' .
            'zhPTCCARowggEApIH9MIH6MT8wPQYDVQQKDDbQnNGW0L3RltGB0YLQtdGA0YHRgtCy0L4g0Y7RgdGC0LjRhtGW0Zcg0KPQutGA0L' .
            'DRl9C90LgxMTAvBgNVBAsMKNCQ0LTQvNGW0L3RltGB0YLRgNCw0YLQvtGAINCG0KLQoSDQptCX0J4xSTBHBgNVBAMMQNCm0LXQvd' .
            'GC0YDQsNC70YzQvdC40Lkg0LfQsNGB0LLRltC00YfRg9Cy0LDQu9GM0L3QuNC5INC+0YDQs9Cw0L0xGTAXBgNVBAUMEFVBLTAwMD' .
            'E1NjIyLTIwMTcxCzAJBgNVBAYTAlVBMREwDwYDVQQHDAjQmtC40ZfQsgIUPbc+e/DVdbICAAAAAQAAALsAAAAwDQYLKoYkAgEBAQ' .
            'EDAQEEQIvIyn+cLBBdRM5wUVGhejzbZo5i9wGW1J7Y4vQC6AFVRj9FgLQmwqkVmCSZZBfKudhmVfVeP2LTXc83LY87+UUwDQYLKo' .
            'YkAgEBAQEDAQEEQJQW+G36erYzuG2dgtE31RdGB1ZAMJDvSkHfsbhacxZkVgcgHF30G4G/GBljI980WpgM8Yj/SuDuPYdT9OzIUC0=',
            $mapped->request_signature
        );
    }
}