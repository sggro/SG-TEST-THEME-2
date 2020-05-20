<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/bigquery/datatransfer/v1/datatransfer.proto

namespace Google\Cloud\BigQuery\DataTransfer\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The returned list transfer run messages.
 *
 * Generated from protobuf message <code>google.cloud.bigquery.datatransfer.v1.ListTransferLogsResponse</code>
 */
class ListTransferLogsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Output only. The stored pipeline transfer messages.
     *
     * Generated from protobuf field <code>repeated .google.cloud.bigquery.datatransfer.v1.TransferMessage transfer_messages = 1;</code>
     */
    private $transfer_messages;
    /**
     * Output only. The next-pagination token. For multiple-page list results,
     * this token can be used as the
     * `GetTransferRunLogRequest.page_token`
     * to request the next page of list results.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     */
    private $next_page_token = '';

    public function __construct() {
        \GPBMetadata\Google\Cloud\Bigquery\Datatransfer\V1\Datatransfer::initOnce();
        parent::__construct();
    }

    /**
     * Output only. The stored pipeline transfer messages.
     *
     * Generated from protobuf field <code>repeated .google.cloud.bigquery.datatransfer.v1.TransferMessage transfer_messages = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTransferMessages()
    {
        return $this->transfer_messages;
    }

    /**
     * Output only. The stored pipeline transfer messages.
     *
     * Generated from protobuf field <code>repeated .google.cloud.bigquery.datatransfer.v1.TransferMessage transfer_messages = 1;</code>
     * @param \Google\Cloud\BigQuery\DataTransfer\V1\TransferMessage[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTransferMessages($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\BigQuery\DataTransfer\V1\TransferMessage::class);
        $this->transfer_messages = $arr;

        return $this;
    }

    /**
     * Output only. The next-pagination token. For multiple-page list results,
     * this token can be used as the
     * `GetTransferRunLogRequest.page_token`
     * to request the next page of list results.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->next_page_token;
    }

    /**
     * Output only. The next-pagination token. For multiple-page list results,
     * this token can be used as the
     * `GetTransferRunLogRequest.page_token`
     * to request the next page of list results.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setNextPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->next_page_token = $var;

        return $this;
    }

}

