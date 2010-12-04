<?php
/*
 CLI.php - Version 1.0b5
 
 PHP Class interface to CommuniGate Pro CLI.
 A translation of CLI.pm
 Derived from:
    CLI.pm 2.6.0
    by Stalker Software, Inc.
    Copyright 2002 Stalker Software, Inc.
    For original Perl version, see:
      http://www.stalker.com/CGPerl/CLI.pm
    
 
 Original location: <http://www.killersoft.com/contrib/cgphp.html>
 Revision history: <http://www.killersoft.com/contrib/cgphp_history.html>
 
 For related info, see:
    <http://www.stalker.com/CommuniGatePro/CLI.html>
    <http://www.stalker.com/CommuniGatePro/CGPerl>
    
 Mail your comments and error reports to <support@killersoft.com>
 
 Translated by Clay Loveless <clay@killersoft.com> April 15-17, 2002.
 
 Credits:
    - Hats off to Stalker for CommuniGate Pro! 
    - Thanks to Matt Gischer for (perhaps unknowingly) providing the kick 
      in the pants to do this.

////////////////////////////////////////////////////////////////////////
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
//
// Hell, it might not even work for you.
//
// By using this code you agree to indemnify Clay Loveless,
// KillerSoft, and Crawlspace, Inc. from any liability that might
// arise from its use.
//
// Have fun!
//
////////////////////////////////////////////////////////////////////////

//////// COMMAND DIFFERENCES BETWEEN CLI.pm and CLI.php
    List commands: "List" is now "ListCommand"
    Server commands: "Shutdown" is now "ServerShutdown"
    Server commands: CLI.pm 2.4.7 has no SetClusterBanned function,
                     but CLI.php does.

//////// NOTES
    If returned array is assocative, command name will be shown with: [returns AA]
    If input array should be associative, command name will be shown with: [requires AA]
    
//////// Commands
    void Login(string PeerAddr, string PeerPort, string login, string password)
    string getErrCode(void)
    string getErrMessage(void)
    string getErrCommand(void)
    bool isSuccess(void)
    void setDebug(bool)
    void setStringsTranslateMode(bool)
    void Logout(void)
    void NewPassword(string newPassword)
    void SendCommand(string command)
    mixed GetResponseData(void)
    
//////// Account Commands
    array ListAccounts([string domainName]) [returns AA]
    void CreateAccount(array params) [requires AA]
    void RenameAccount(string oldAccountName, string newAccountName)
    void DeleteAccount(string accountName)
    array GetAccountSettings(string accountName) [returns AA]
    array GetAccount(string accountName) [returns AA]
    array GetAccountEffectiveSettings(string accountName) [returns AA]
    void UpdateAccountSettings(string accountName, array params) [requires AA]
    void UpdateAccount(string accountName, array params) [requires AA]
    void SetAccountSettings(string accountName, array params) [requires AA]
    void SetAccount(string accountName, array params) [requires AA]
    void SetAccountPassword(string accountName, string newPass)
    void VerifyAccountPassword(string accountName, string password)
    array GetAccountAliases(string accountName)
    void SetAccountAliases(string accountName, array aliases)
    array GetAccountRules(string accountName) [returns array of arrays]
    void SetAccountRules(string accountName, array rules) [requires array of arrays]
    array GetAccountRPOP(string accountName)
    void SetAccountRPOP(string accountName, array details)
    array GetAccountRights(string accountName)
    void SetAccountRights(string accountName,array rights)
    mixed GetAccountInfo(string accountName, string key)
    array GetWebUser(string accountName) [returns AA]
    void SetWebUser(string accountName, array settings) [requires AA]

//////// Group Commands
    array ListGroups([string domainName])
    void CreateGroup(string groupName[, array settings]) [optional AA for settings]
    void RenameGroup(string oldGroupName, string newGroupName)
    void DeleteGroup(string groupName)
    array GetGroup(string groupName) [returns AA]
    void SetGroup(string groupName, array settings)

//////// Forwarder Commands
    array ListForwarders([string domainName)
    void CreateForwarder(string forwarderName, string address)
    void DeleteForwarder(string forwarderName)
    string GetForwarder(string forwarderName)

//////// Domain Commands
    array ListDomains()
    string MainDomainName()
    array GetDomainSettings([string domainName])
    array GetDomain([string domainName])
    array GetDomainEffectiveSettings([string domainName])
    void UpdateDomainSettings(array params) [requires AA]
    void UpdateDomain(array params) [requires AA]
    void SetDomainSettings(array params) [requires AA]
    void SetDomain(array params) [requires AA]
    void CreateDomain(string domainName[, array params]) [optional AA for parameters]
    void RenameDomain(string oldDomainName, string newDomainName)
    void DeleteDomain(string domainName[, bool force])
    void CreateSharedDomain(string domainName[, array params]) [optional AA for parameters]
    void CreateDirectoryDomain(string domainName[, array params]) [optional AA for parameters]
    void ReloadDirectoryDomains()
    array GetDomainAliases([string domainName])
    void SetDomainAliases(string domainName, array aliases)
    array ListAdminDomains([string domainName])
    array GetDirectoryIntegration() [returns AA]
    void SetDirectoryIntegration(array settings)
    array GetClusterDirectoryIntegration() [returns AA]
    void SetClusterDirectoryIntegration(array settings)
    array GetDomainDefaults()
    void UpdateDomainDefaults(array settings) [requires AA]
    void SetDomainDefaults(array settings) [requires AA]
    array GetClusterDomainDefaults() [returns AA]
    void UpdateClusterDomainDefaults(array settings) [requires AA]
    void SetClusterDomainDefaults(array settings) [requires AA]
    array GetAllAccountsDefaults() [returns AA]
    void UpdateAllAccountsDefaults(array settings) [requires AA]
    void SetAllAccountsDefaults(array settings) [requires AA]
    array GetClusterAccountsDefaults() [returns AA]
    void UpdateClusterAccountsDefaults(array settings) [requires AA]
    void SetClusterAccountsDefaults(array settings) [requires AA]
    string GetAccountLocation(string accountName)
    array GetAccountDefaults([string domainName])
    void UpdateAccountDefaults(array params) [requires AA]
    void SetAccountDefaults(array params) [requires AA]
    array GetWebUserDefaults([string domainName]) [returns AA]
    void SetWebUserDefaults(array params) [requires AA]
    array GetAccountTemplate([string domainName]) [returns AA]
    void UpdateAccountTemplate(array params) [requires AA]
    void SetAccountTemplate(array params) [requires AA]

//////// Mailbox Administration Commands
    array ListMailboxes(array params) [returns AA, requires AA]
    void CreateMailbox(string accountName, string mailboxName[, string authAccountName])
    void RenameMailbox(string accountName, string oldMailboxName, string newMailboxName[, string authAccountName])
    void RenameMailboxes(string accountName, string oldMailboxName, string newMailboxName[, string authAccountName])
    void DeleteMailbox(string accountName, string mailboxName[, string authAccountName])
    void DeleteMailboxes(string accountName, string mailboxName[, string authAccountName])
    array GetMailboxInfo(string accountName, string mailboxName[, string authAccountName]) [returns AA]
    array GetMailboxACL(string accountName, string mailboxName[, string authAccountName]) [returns AA]
    void SetMailboxACL(string accountName,string mailboxName, array newACL[, string authAccountName]) [requires AA for newACL]
    string GetMailboxRights(string accountName, string mailboxName[, string authAccountName])
    array GetAccountSubscription(string accountName)
    void SetAccountSubscription(string accountName,array newSubscription)
    array GetMailboxAliases(string accountName) [returns AA]
    void SetMailboxAliases(string accountName, array newAliases) [requires AA for newAliases]

//////// Alerts Administration Commands
    array GetDomainAlerts([string domain]) [returns AA]
    void SetDomainAlerts(string domain, array alerts) [requires AA]
    void PostDomainAlert(string domain, string alert)
    void RemoveDomainAlert(string domain, string timestamp)
    array GetAccountAlerts([string account]) [returns AA]
    void SetAccountAlerts(string account, array alerts) [requires AA]
    void PostAccountAlert(string account, string alert)
    void RemoveAccountAlert(string account, string timestamp)
    array GetServerAlerts() [returns AA]
    void SetServerAlerts(array alerts) [requires AA]
    void PostServerAlert(string alert)
    void RemoveServerAlert(string timestamp)
    array GetClusterAlerts() [returns AA]
    void SetClusterAlerts(array alerts) [requires AA]
    void PostClusterAlert(string alert)
    void RemoveClusterAlert(string timestamp)

//////// Personal Website Adminstration Commands
    array GetWebFile(string accountName, string fileName)
    void PutWebFile(string accountName, string fileName, string base64data)
    void RenameWebFile(string accountName, string oldFileName, string newFileName)
    void DeleteWebFile(string accountName, string fileName)
    array ListWebFiles(string accountName[, string filePath]) [returns AA]
    array GetWebFilesInfo(string accountName)

//////// Lists Commands
    array ListLists([string domain])
    array GetDomainLists([string domain]) [returns AA]
    array GetAccountLists(string accountName) [returns AA]
    void CreateList(string listName, string accountName)
    void RenameList(string oldListName, string newListName)
    void DeleteList(string listName)
    array GetList(string listName) [returns AA]
    void UpdateList(string listName, array params) [requires AA for parameters]
    void ListCommand(string listName, string command, string subscriber, array options)
    array ListSubscribers(string listName[, string filter[, int limit]])
    array GetSubscriberInfo(string listName, string address)
    void SetPostingMode(string listName, string address, string mode)

//////// Web Skins Administration Commands
    array ListDomainSkins(string domainName)
    void CreateDomainSkin(string domainName, string skinName)
    void RenameDomainSkin(string domainName, string oldSkinName, string newSkinName)
    void DeleteDomainSkin(string domainName, string skinName)
    array ListDomainSkinFiles(string domainName, string skinName) [returns AA]
    array ReadDomainSkinFile(string domainName, string skinName, string fileName)
    void StoreDomainSkinFile(string domainName, string skinName, string fileName, string base64data)
    void DeleteDomainSkinFile(string domainName, string skinName, string fileName)
    array ListServerSkins()
    void CreateServerSkin(string skinName)
    void RenameServerSkin(string oldSkinName, string newSkinName)
    void DeleteServerSkin(string skinName)
    array ListServerSkinFiles(string skinName) [returns AA]
    array ReadServerSkinFile(string skinName, string fileName)
    void StoreServerSkinFile(string skinName, string fileName, string base64data)
    void DeleteServerSkinFile(string skinName, string fileName)
    array ListClusterSkins()
    void CreateClusterSkin(string skinName)
    void RenameClusterSkin(string oldSkinName, string newSkinName)
    void DeleteClusterSkin(string skinName)
    array ListClusterSkinFiles(string skinName) [returns AA]
    array ReadClusterSkinFile(string skinName, string fileName)
    void StoreClusterSkinFile(string skinName, string fileName, string bas64data)
    void DeleteClusterSkinFile(string skinName, string fileName)

//////// Web Interface Tuning Commands
    array ListWebUserInterface([string domainName[, string path]]) [returns AA]
    string GetWebUserInterface(string domainName, string fileName)
    void PutWebUserInterface(string domainName, string fileName, string base64data)
    void DeleteWebUserInterface(string domainName, string path)
    void ClearWebUserCache([string domainName])

//////// Web Interface Integration Commands
    void CreateWebUserSession(string accountName, string ipAddress)
    array GetWebUserSession(string sessionID) [returns AA]
    void KillWebUserSession(string sessionID)

//////// Server Commands
    array GetModule(string moduleName) [returns AA]
    void UpdateModule(string moduleName, array newSettings) [requires AA for newSettings]
    void SetModule(string moduleName, array settings) [requires AA for settings]
    string GetBlacklistedIPs(void)
    string GetClientIPs(void)
    string GetWhiteHoleIPs(void)
    string GetProtection(void)
    string GetBanned(void)
    void SetBlacklistedIPs(string addresses)
    void SetClientIPs(string addresses)
    void SetWhiteHoleIPs(string addresses)
    void SetProtection(string settings)
    void SetBanned(string settings)
    string GetClusterBlacklistedIPs(void)
    string GetClusterClientIPs(void)
    string GetClusterWhiteHoleIPs(void)
    string GetClusterProtection(void)
    string GetClusterBanned(void)
    void SetClusterBlacklistedIPs(string addresses)
    void SetClusterClientIPs(string addresses)
    void SetClusterWhiteHoleIPs(string addresses)
    void SetClusterProtection(string settings)
    void SetClusterBanned(string settings)
    array GetServerRules(void) [returns array of arrays]
    void SetServerRules(array rules)
    array GetClusterRules(void) [returns array of arrays]
    void SetClusterRules(array rules)
    void RefreshOSData(void)
    string GetRouterTable(void)
    void SetRouterTable(string table)
    string GetClusterRouterTable(void)
    void SetClusterRouterTable(string table)
    void Route(string address)

//////// Monitoring Commands
    array GetSNMPElement(string element)
    void ServerShutdown(void)

//////// Statistics Commands
    mixed GetAccountStat(string accountName[, string key])
    void ResetAccountStat(string accountName[, string key])
    mixed GetDomainStat(string domainName[, string key])
    void ResetDomainStat(string domainName[, string key])

//////// Miscellaneous Commands
    void WriteLog(int level, string msg)
    void ReleaseSMTPQueue(string queueName)

 
*/
if(!defined('PHP_CGP_CLI_CLASS')) {
    
    define('PHP_CGP_CLI_CLASS',1);
    
    class CLI {
        
        
        
        // class variables
        var $PeerAddr               = '';
        var $PeerPort               = 106;
        var $login                  = '';
        var $password               = '';
        var $debug                  = 0;
        var $translateStrings       = 0;
        var $span                   = 0;
        var $len                    = 0;
        var $data                   = '';
        var $errCode                = '';
        var $errMsg                 = '';
        var $currentCGateCommand    = '';
        var $inlineResponse         = '';
    
        
        // Connect to the server
        function Login($PeerAddr, $PeerPort, $login, $password) {
            
            // Must have a login and password
            if (!isset( $login )) {
                die ("You must pass login parameter to cgpCLI\n");
            }
            if (!isset( $password )) {
                die ("You must pass password paramter to cgpCLI\n");
            }
            $out = '';
            $sp = fsockopen( $PeerAddr, $PeerPort, $errno, $errstr );
            if($sp) {

                $this->sp = $sp;


                // set our created socket for $sp to 
                // non-blocking mode so that our fgets()
                // calls will return with a quickness
                if (function_exists('stream_set_blocking')) {
                    stream_set_blocking ( $sp, false );
                } else {
                    set_socket_blocking ( $sp, false );
                }
                
                // get greeting
                while($out == '') {
                    $out = fgets($sp, 1024);
                }
                if($this->debug)
                    echo "$out";
                
                // reset our socket pointer to blocking mode,
                // so we can wait for communication to finish
                // before moving on ...
                if (function_exists('stream_set_blocking')) {
                    stream_set_blocking ( $sp, true );
                } else {
                    set_socket_blocking ( $sp, true );
                }
                
                // secure login -- grab what we need from greeting
                preg_match("/(\<.*\@*\>)/",$out,$matches);
                $this->send('APOP '.$login.' '.md5($matches[1].$password));
                $this->_parseResponse();
                
                // Set to INLINE mode
                $this->send('INLINE');
                $this->_parseResponse();
                
            } else {
                echo "$errno: $errstr\n";
                exit;
            }
                
        
        }

        //////////////////////////////////////////////////
        // General commands
        
        function getErrCode() {
            return $this->errCode;
        }
        
        function getErrMessage() {
            return $this->errMsg;
        }
        
        function getErrCommand() {
            return $this->currentCGateCommand;
        }
        
        function isSuccess() {
            if($this->errCode == 200 || $this->errCode == 201) {
                return true;
            } else {
                return false;
            }
        }
        
        function setDebug($debugFlag) {
            $this->debug = $debugFlag;
        }
        
        function setStringsTranslateMode($onFlag) {
            $this->translateStrings = $onFlag;
        }
        
        function Logout() {
            $this->send('QUIT');
            if($this->debug)
                $this->_parseResponse();
            fclose($this->sp);
        }
        
        function NewPassword($newPassword) {
            if(!isset($newPassword))
                die('usage: $cli->NewPassword($newPassword)'."\n");
            $this->send('NEWPASS '.$newPassword);
            $this->_parseResponse();
        }
        
        function SendCommand($command) {
            if(!isset($command))
                die('usage: $cli->SendCommand($commandString)'."\n");
            $this->send($command);
            $this->_parseResponse();
        }
        
        function GetResponseData() {
            return $this->parseWords($this->getWords());
        }
        
        
        
        //////////////////////////////////////////////////
        // Account commands     
        
        function ListAccounts($domain='') {
            $command = 'LSTACNT';
            if($domain != '') $command .= ' '.$domain;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function CreateAccount($params) {
            if(!array_key_exists("accountName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $UserData = array('."\n";
                $err .= '       "accountName" => "john",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "AccessModes" => "Mail POP IMAP PWD WebMail WebSite",'."\n";
                $err .= '           "RealName" => "John X. Smith",'."\n";
                $err .= '           "MaxAccountSize" => "100k"'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->CreateAccount(array $UserData);'."\n";
                die("$err");
            } else {
                $command = 'CRACNT '.$params["accountName"];
                if(array_key_exists("accountType",$params) && isset($params["accountType"]))
                    $command .= ' '. $params["accountType"];
                if(array_key_exists("externalFlag",$params))
                    $command .= ' '. 'external';
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }
        
        function RenameAccount($oldAccountName,$newAccountName) {
            if($oldAccountName == '' || $newAccountName == '') 
                die('usage: $cli->RenameAccount(string $oldAccountName, string $newAccountName)'."\n");
            $this->send('RNACNT '.$oldAccountName.' into '.$newAccountName);
            $this->_parseResponse();
        }
        
        function DeleteAccount($accountName) {
            if($accountName == '')
                die('usage: $cli->DeleteAccount(string $accountName)'."\n");
            $this->send('DLACNT '.$accountName);
            $this->_parseResponse();
        }
        
        function GetAccountSettings($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountSettings(string $accountName)'."\n");
            $this->send('GTACNT '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            } else {
                return false;
            }
        }
        
        function GetAccount($accountName) {
            return $this->GetAccountSettings($accountName);
        }
        
        function GetAccountEffectiveSettings($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountEffectiveSettings(string $accountName)'."\n");
            $this->send('GetAccountEffectiveSettings '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            } else {
                return false;
            }
        }
        
        function UpdateAccountSettings($accountName,$params) {
            if($accountName == '' || !is_array($params)) 
                die('usage: $cli->UpdateAccountSettings(string $accountName, array $settings)'."\n");
            $this->send('UPDACNT '.$accountName.' '.$this->printWords($params));
            $this->_parseResponse();
        }
        
        function UpdateAccount($accountName,$params) {
            return $this->UpdateAccountSettings($accountName,$params);
        }
        
        function SetAccountSettings($accountName,$params) {
            if($accountName == '' || !is_array($params)) 
                die('usage: $cli->SetAccountSettings(string $accountName, array $settings)'."\n");
            $this->send('STACNT '.$accountName.' '.$this->printWords($params));
            $this->_parseResponse();
        }
        
        function SetAccount($accountName,$params) {
            return $this->SetAccountSettings($accountName,$params);
        }
        
        function SetAccountPassword($accountName,$newPass) {
            if($accountName == '' || $newPass == '') 
                die('usage: $cli->SetAccountPassword(string $accountName, string $newPassword)'."\n");
            $this->send('SetAccountPassword '.$accountName.' TO '.$this->printWords($newPass));
            $this->_parseResponse();
        }
        
        function VerifyAccountPassword($accountName,$pass) {
            if($accountName == '' || $pass == '')
                die('usage: $cli->VerifyAccountPassword(string $accountName, string $password)'."\n");
            $this->send('VerifyAccountPassword '.$accountName.' PASSWORD '.$this->printWords($pass));
            return $this->_parseResponse();
        }
        
        function GetAccountAliases($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountAliases(string $accountName)'."\n");
            $this->send('GTACNTALS '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            } else {
                return '';
            }
        }
        
        function SetAccountAliases($accountName,$aliases) {
            if($accountName == '' || !is_array($aliases))
                die('usage: $cli->SetAccountAliases(string $accountName, array $aliases)'."\n");
            $this->send('STACNTALS '.$accountName.' '.$this->printWords($aliases));
            $this->_parseResponse();
        }

        function GetAccountRules($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountRules(string $accountName)'."\n");
            $this->send('GTACNTRL '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetAccountRules($accountName,$rules) {
            if($accountName == '' || !is_array($rules))
                die('usage: $cli->SetAccountRules(string $accountName, array $rules)'."\n");
            $this->send('STACNTRL '.$accountName.' '.$this->printWords($rules));
            $this->_parseResponse();
        }
        
        function GetAccountRPOP($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountRPOP(string $accountName)'."\n");
            $this->send('GetAccountRPOP '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function SetAccountRPOP($accountName,$details) {
            if($accountName == '' || !is_array($details))
                die('usage: $cli->SetAccountRPOP(string $accountName, array $details)'."\n");
            $this->send('SetAccountRPOP '.$accountName.' '.$this->printWords($details));
            $this->_parseResponse();
        }

        function GetAccountRights($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountRights(string $accountName)'."\n");
            $this->send('GTACNTRGHT '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetAccountRights($accountName,$rights) {
            if($accountName == '' || !is_array($rights))
                die('usage: $cli->SetAccountRights(string $accountName, array $rights)'."\n");
            $this->send('STACNTRGHT '.$accountName.' '.$this->printWords($rights));
            $this->_parseResponse();
        }

        function GetAccountInfo($accountName,$key) {
            if($accountName == '' || $key == '')
                die('usage: $cli->GetAccountInfo(string $accountName, string $key)'."\n");
            $this->send('GTACNTINF '.$accountName.' Key '.$key);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetWebUser($accountName) {
            if($accountName == '')
                die('usage: $cli->GetWebUser(string $accountName)'."\n");
            $this->send('GTWUSR '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetWebUser($accountName,$settings) {
            if($accountName == '' || !is_array($settings))
                die('usage: $cli->SetWebUser(string $accountName, array $settings)'."\n");
            $this->send('STWUSR '.$accountName.' '.$this->printWords($settings));
            $this->_parseResponse();
        }

        //////////////////////////////////////////////////
        // Group commands       

        function ListGroups($domainName='') {
            $command = 'ListGroups';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function CreateGroup($groupName,$settings='') {
            if($groupName == '')
                die('usage: $cli->CreateGroup(string $groupName[, array $settings])'."\n");
            $command = 'CreateGroup '.$groupName;
            if(is_array($settings)) $command .= ' '.$this->printWords($settings);
            $this->send($command);
            $this->_parseResponse();
        }

        function RenameGroup($oldGroupName,$newGroupName) {
            if($oldGroupName == '' || $newGroupName == '')
                die('usage: $cli->RenameGroup(string $oldGroupName, string $newGroupName)'."\n");
            $this->send('RenameGroup '.$oldGroupName.' into '.$newGroupName);
            $this->_parseResponse();
        }
        
        function DeleteGroup($groupName) {
            if($groupName == '')
                die('usage: $cli->DeleteGroup(string $groupName)'."\n");
            $this->send('DeleteGroup '.$groupName);
            $this->_parseResponse();
        }
        
        function GetGroup($groupName) {
            if($groupName == '')
                die('usage: $cli->GetGroup(string $groupName)'."\n");
            $this->send('GetGroup '.$groupName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function SetGroup($groupName,$settings) {
            if($groupName == '' || !is_array($settings))
                die('usage: $cli->SetGroup(string $groupName, array $settings)'."\n");
            $this->send('SetGroup '.$groupName.' '.$this->printWords($settings));
            $this->_parseResponse();
        }

        //////////////////////////////////////////////////
        // Forwarder commands       

        function ListForwarders($domainName='') {
            $command = 'ListForwarders';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function CreateForwarder($forwarderName,$address) {
            if($forwarderName == '' || $address == '')
                die('usage: $cli->CreateForwarder(string $forwarderName, string $address)'."\n");
            $this->send('CreateForwarder '.$forwarderName.' TO '.$this->printWords($address));
            $this->_parseResponse();
        }

        function DeleteForwarder($forwarderName) {
            if($forwarderName == '')
                die('usage: $cli->DeleteForwarder(string $forwarderName)'."\n");
            $this->send('DeleteForwarder '.$forwarderName);
            $this->_parseResponse();
        }
        
        function GetForwarder($forwarderName) {
            if($forwarderName == '')
                die('usage: $cli->GetForwarder(string $forwarderName)'."\n");
            $this->send('GetForwarder '.$forwarderName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        //////////////////////////////////////////////////
        // Domain commands      

        function ListDomains() {
            $this->send('LSTDMN');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function MainDomainName() {
            $this->send('MainDomainName');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetDomainSettings($domainName='') {
            $command = 'GTDMN';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetDomain($domainName='') {
            return $this->GetDomainSettings($domainName='');
        }
            
        function GetDomainEffectiveSettings($domainName='') {
            $command = 'GetDomainEffectiveSettings';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateDomainSettings($params) {
            if(!array_key_exists("domainName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $DomainData = array('."\n";
                $err .= '       "domainName" => "domain.com",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "WebUserCache" => "NO",'."\n";
                $err .= '           "AutoSignup" => "YES"'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->UpdateDomainSettings(array $DomainData);'."\n";
                die("$err");
            } else {
                $command = 'UPDDMN '.$params["domainName"];
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }
        
        function UpdateDomain($params) {
            return $this->UpdateDomainSettings($params);
        }

        function SetDomainSettings($params) {
            if(!array_key_exists("domainName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $DomainData = array('."\n";
                $err .= '       "domainName" => "domain.com",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "WebUserCache" => "NO",'."\n";
                $err .= '           "AutoSignup" => "YES"'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->SetDomainSettings(array $DomainData);'."\n";
                die("$err");
            } else {
                $command = 'SetDomainSettings '.$params["domainName"];
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }

        function SetDomain($params) {
            return $this->SetDomainSettings($params);
        }

        function CreateDomain($domainName,$params='') {
            if($domainName == '')
                die('usage: $cli->CreateDomain(string $domainName[, array $settings])'."\n");
            $command = 'CRDMN '.$domainName;
            if(is_array($params)) $command .= ' '.$this->printWords($params);
            $this->send($command);
            $this->_parseResponse();
        }
        
        function RenameDomain($oldDomainName,$newDomainName) {
            if($oldDomainName == '' || $newDomainName == '')
                die('usage: $cli->RenameDomain(string $oldDomainName, string $newDomainName)'."\n");
            $this->send('RNDMN '.$oldDomainName.' into '.$newDomainName);
            $this->_parseResponse();
        }
        
        function DeleteDomain($domainName,$force=0) {
            if($domainName == '')
                die('usage: $cli->DeleteDomain(string $domainName[, bool $force])'."\n");
            $command = 'DLDMN '.$domainName;
            if($force > 0)
                $command .= ' force';
            $this->send($command);
            $this->_parseResponse();
        }
        
        function CreateSharedDomain($domainName,$params = '') {
            if($domainName == '')
                die('usage: $cli->CreateSharedDomain(string $domainName[, array $params])'."\n");
            $command = 'CreateSharedDomain '.$domainName;
            if(is_array($params))
                $command .= ' '.$this->printWords($params);
            $this->send($command);
            $this->_parseResponse();
        }
        
        function CreateDirectoryDomain($domainName,$params = '') {
            if($domainName == '')
                die('usage: $cli->CreateDirectoryDomain(string $domainName[, array $params])'."\n");
            $command = 'CreateDirectoryDomain '.$domainName;
            if(is_array($params))
                $command .= ' '.$this->printWords($params);
            $this->send($command);
            $this->_parseResponse();
        }
        
        function ReloadDirectoryDomains() {
            $this->send('ReloadDirectoryDomains');
            $this->_parseResponse();
        }
        
        function GetDomainAliases($domainName='') {
            $command = 'GTDMNALS';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetDomainAliases($domainName, $aliases) {
            if($domainName == '' || !is_array($aliases))
                die('usage: $cli->SetDomainAliases(string $domainName, array $aliases)'."\n");
            $this->send('STDMNALS '.$domainName.' '.$this->printWords($aliases));
            $this->_parseResponse();
        }

        function ListAdminDomains($domainName='') {
            $command = 'ListAdminDomains';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetDirectoryIntegration() {
            $this->send('GetDirectoryIntegration');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function SetDirectoryIntegration($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->SetDirectoryIntegration(array $settings)'."\n");
            $this->send('SetDirectoryIntegration '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function GetClusterDirectoryIntegration() {
            $this->send('GetClusterDirectoryIntegration');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function SetClusterDirectoryIntegration($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->SetClusterDirectoryIntegration(array $settings)'."\n");
            $this->send('SetClusterDirectoryIntegration '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function GetDomainDefaults() {
            $this->send('GTDMNDFL');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateDomainDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->UpdateDomainDefaults(array $settings)'."\n");
            $this->send('UPDDMNDFL '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function SetDomainDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->SetDomainDefaults(array $settings)'."\n");
            $this->send('SetDomainDefaults '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function GetClusterDomainDefaults() {
            $this->send('GetClusterDomainDefaults');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateClusterDomainDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->UpdateClusterDomainDefaults(array $settings)'."\n");
            $this->send('UpdateClusterDomainDefaults '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function SetClusterDomainDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->SetClusterDomainDefaults(array $settings)'."\n");
            $this->send('SetClusterDomainDefaults '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function GetAllAccountsDefaults() {
            $this->send('GTALACNDFL');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateAllAccountsDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->UpdateAllAccountsDefaults(array $settings)'."\n");
            $this->send('UPDALACNDFL '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function SetAllAccountsDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->SetAllAccountsDefaults(array $settings)'."\n");
            $this->send('SetAllAccountsDefaults '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function GetClusterAccountsDefaults() {
            $this->send('GetClusterAccountsDefaults');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateClusterAccountsDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->UpdateClusterAccountsDefaults(array $settings)'."\n");
            $this->send('UpdateClusterAccountsDefaults '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function SetClusterAccountsDefaults($settings) {
            if(!is_array($settings)) 
                die('usage: $cli->SetClusterAccountsDefaults(array $settings)'."\n");
            $this->send('SetClusterAccountsDefaults '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function GetAccountLocation($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountLocation(string $accountName)'."\n");
            $this->send('GetAccountLocation '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetAccountDefaults($domainName='') {
            $command = 'GTACNDFL';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateAccountDefaults($params) {
            if(!array_key_exists("domainName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $AccountDefaults = array('."\n";
                $err .= '       "domainName" => "domain.com",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "AccessModes" => "Mail POP IMAP PWD WebMail WebSite",'."\n";
                $err .= '           "MaxAccountSize" => "100k"'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->UpdateAccountDefaults(array $AccountDefaults);'."\n";
                die("$err");
            } else {
                $command = 'UPDACNDFL '.$params["domainName"];
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }

        function SetAccountDefaults($params) {
            if(!array_key_exists("domainName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $AccountDefaults = array('."\n";
                $err .= '       "domainName" => "domain.com",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "AccessModes" => "Mail POP IMAP PWD WebMail WebSite",'."\n";
                $err .= '           "MaxAccountSize" => "100k"'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->SetAccountDefaults(array $AccountDefaults);'."\n";
                die("$err");
            } else {
                $command = 'STACNDFL '.$params["domainName"];
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }

        function GetWebUserDefaults($domainName='') {
            $command = 'GTWUSRDFL';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }


        function SetWebUserDefaults($params) {
            if(!array_key_exists("domainName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $WebUserDefaults = array('."\n";
                $err .= '       "domainName" => "domain.com",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "Fields" => "From Sender Subject Date To Cc",'."\n";
                $err .= '           "Charset" => "ISO-8859-1"'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->SetWebUserDefaults(array $WebUserDefaults);'."\n";
                die("$err");
            } else {
                $command = 'STWUSRDFL '.$params["domainName"];
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }

        function GetAccountTemplate($domainName='') {
            $command = 'GTACNTMP';
            if($domainName != '') $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateAccountTemplate($params) {
            if(!array_key_exists("domainName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $AccountTemplate = array('."\n";
                $err .= '       "domainName" => "domain.com",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "Real Name" => "Unnamed",'."\n";
                $err .= '           "Password" => ""'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->UpdateAccountTemplate(array $AccountTemplate);'."\n";
                die("$err");
            } else {
                $command = 'UPDACNTMP '.$params["domainName"];
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }

        function SetAccountTemplate($params) {
            if(!array_key_exists("domainName",$params)) {
                $err = 'usage:'."\n";
                $err .= '   $AccountTemplate = array('."\n";
                $err .= '       "domainName" => "domain.com",'."\n";
                $err .= '       "settings" => array('."\n";
                $err .= '           "Real Name" => "Unnamed",'."\n";
                $err .= '           "Password" => ""'."\n";
                $err .= '           )'."\n";
                $err .= '       );'."\n";
                $err .= '   $cli->SetAccountTemplate(array $AccountTemplate);'."\n";
                die("$err");
            } else {
                $command = 'STACNTMP '.$params["domainName"];
                if(is_array($params["settings"]))
                    $command .= ' '.$this->printWords($params["settings"]);
                $this->send($command);
                $this->_parseResponse();
            }   
        }
        

        //////////////////////////////////////////////////
        // Mailbox management commands      

        function ListMailboxes($params) {
            if(!is_array($params)) {
                $err = 'usage:'."\n";
                $err .= '   $parameters = array('."\n";
                $err .= '       "accountName" => "joe@domain.com",'."\n";
                $err .= '       "filter" => "INBOX*",'."\n";
                $err .= '       "authAccountName" => '."\n";
                $err .= '   );\n';
                $err .= '   $cli->ListMailboxes($parameters)'."\n";
                die("$err");
            } else {
                $command = 'LSTMBX '.$params["accountName"];
                if(array_key_exists("filter",$params)) {
                    $command .= ' FILTER '.$this->printWords($params["filter"]);
                }
                if(array_key_exists("authAccountName",$params) && $params["authAccountName"] != '') {
                    $command .= ' AUTH '.$params["authAccountName"];
                }
                $this->send($command);
                $this->_parseResponse();
                if($this->isSuccess()) {
                    return $this->parseWords($this->getWords());
                }
            }
        }
        
        function CreateMailbox($accountName,$mailboxName,$authAccountName='') {
            if($accountName == '' || $mailboxName == '')
                die('usage: $cli->CreateMailbox(string $accountName, string $mailboxName[, string $authAccountName])'."\n");
            $command = 'CREATEMAILBOX '.$accountName;
            $command .= ' MAILBOX '.$this->printWords($mailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
        }
        
        function RenameMailbox($accountName,$oldMailboxName,$newMailboxName,$authAccountName='') {
            if($accountName == '' || $oldMailboxName == '' || $newMailboxName == '')
                die('usage: $cli->RenameMailbox(string $accountName, string $oldMailboxName, string $newMailboxName[, string $authAccountName])'."\n");
            $command = 'RENAMEMAILBOX '.$accountName;
            $command .= ' MAILBOX '.$this->printWords($oldMailboxName);
            $command .= ' INTO '.$this->printWords($newMailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
        }

        function RenameMailboxes($accountName,$oldMailboxName,$newMailboxName,$authAccountName='') {
            if($accountName == '' || $oldMailboxName == '' || $newMailboxName == '')
                die('usage: $cli->RenameMailboxes(string $accountName, string $oldMailboxName, string $newMailboxName[, string $authAccountName])'."\n");
            $command = 'RENAMEMAILBOX '.$accountName;
            $command .= ' MAILBOXES '.$this->printWords($oldMailboxName);
            $command .= ' INTO '.$this->printWords($newMailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
        }
        
        function DeleteMailbox($accountName,$mailboxName,$authAccountName='') {
            if($accountName == '' || $mailboxName == '')
                die('usage: $cli->DeleteMailbox(string $accountName, string $mailboxName[, string $authAccountName])'."\n");
            $command = 'DELETEMAILBOX '.$accountName;
            $command .= ' MAILBOX '.$this->printWords($mailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
        }
        
        function DeleteMailboxes($accountName,$mailboxName,$authAccountName='') {
            if($accountName == '' || $mailboxName == '')
                die('usage: $cli->DeleteMailboxes(string $accountName, string $mailboxName[, string $authAccountName])'."\n");
            $command = 'DELETEMAILBOX '.$accountName;
            $command .= ' MAILBOXES '.$this->printWords($mailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
        }
        
        function GetMailboxInfo($accountName,$mailboxName,$authAccountName='') {
            if($accountName == '' || $mailboxName == '')
                die('usage: $cli->GetMailboxInfo(string $accountName, string $mailboxName[, string $authAccountName])'."\n");
            $command = 'GETMAILBOXINFO '.$accountName;
            $command .= ' MAILBOX '.$this->printWords($mailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetMailboxACL($accountName,$mailboxName,$authAccountName='') {
            if($accountName == '' || $mailboxName == '')
                die('usage: $cli->GetMailboxACL(string $accountName, string $mailboxName[, string $authAccountName])'."\n");
            $command = 'GETMAILBOXACL '.$accountName;
            $command .= ' MAILBOX '.$this->printWords($mailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function SetMailboxACL($accountName,$mailboxName,$newACL,$authAccountName='') {
            if($accountName == '' || $mailboxName == '' || !is_array($newACL))
                die('usage: $cli->SetMailboxACL(string $accountName, string $mailboxName, array $newACL[, string $authAccountName])'."\n");
            $command = 'SETMAILBOXACL '.$accountName;
            $command .= ' MAILBOX '.$this->printWords($mailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $command .= ' '.$this->printWords($newACL);
            $this->send($command);
            $this->_parseResponse();
        }
        
        function GetMailboxRights($accountName,$mailboxName,$authAccountName='') {
            if($accountName == '' || $mailboxName == '')
                die('usage: $cli->GetMailboxRights(string $accountName, string $mailboxName[, string $authAccountName])'."\n");
            $command = 'GETMAILBOXRIGHTS '.$accountName;
            $command .= ' MAILBOX '.$this->printWords($mailboxName);
            if($authAccountName != '') {
                $command .= ' AUTH '.$authAccountName;
            }
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetAccountSubscription($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountSubscription(string $accountName)'."\n");
            $this->send('GetAccountSubscription '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function SetAccountSubscription($accountName,$newSubscription) {
            if($accountName == '' || !is_array($newSubscription))
                die('usage: $cli->SetAccountSubscription(string $accountName, array $newSubscription)'."\n");
            $this->send('SetAccountSubscription '.$accountName.' '.$this->printWords($newSubscription));
            $this->_parseResponse();
        }
        
        function GetMailboxAliases($accountName) {
            if($accountName == '')
                die('usage: $cli->GetMailboxAliases(string $accountName)'."\n");
            $this->send('GetMailboxAliases '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function SetMailboxAliases($accountName,$newAliases) {
            if($accountName == '' || !is_array($newAliases))
                die('usage: $cli->SetMailboxAliases(string $accountName, array $newAliases)'."\n");
            $this->send('SetMailboxAliases '.$accountName.' '.$this->printWords($newAliases));
            $this->_parseResponse();
        }
        
        
        //////////////////////////////////////////////////
        // Alerts administration commands       

        function GetDomainAlerts($domain='') {
            $command = 'GTALRT';
            if($domain != '') $command .= ' '.$domain;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetDomainAlerts($domain,$alerts) {
            if($domain == '' || !is_array($alerts))
                die('usage: $cli->SetDomainAlerts(string $domain, array $alerts)'."\n");
            $this->send('STALRT '.$domain.' '.$this->printWords($alerts));
            $this->_parseResponse();
        }

        function PostDomainAlert($domain,$alert) {
            if($domain == '' || $alert == '')
                die('usage: $cli->PostDomainAlert(string $domain, string $alert)'."\n");
            $this->send('PostDomainAlert '.$domain.' ALERT '.$this->printWords($alert));
            $this->_parseResponse();
        }       

        function RemoveDomainAlert($domain,$timestamp) {
            if($domain == '' || $timestamp == '')
                die('usage: $cli->RemoveDomainAlert($domain, $timestamp)'."\n");
            $this->send('RemoveDomainAlert '.$domain.' ALERT '.$timestamp);
            $this->_parseResponse();
        }
        
        function GetAccountAlerts($account) {
            $command = 'GetAccountAlerts '.$account;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetAccountAlerts($account,$alerts) {
            if($account == '' || !is_array($alerts))
                die('usage: $cli->SetAccountAlerts(string $account, array $alerts)'."\n");
            $this->send('SetAccountAlerts '.$account.' '.$this->printWords($alerts));
            $this->_parseResponse();
        }

        function PostAccountAlert($account,$alert) {
            if($account == '' || $alert == '')
                die('usage: $cli->PostAccountAlert(string $account, string $alert)'."\n");
            $this->send('PostAccountAlert '.$domain.' ALERT '.$this->printWords($alert));
            $this->_parseResponse();
        }       

        function RemoveAccountAlert($account,$timestamp) {
            if($account == '' || $timestamp == '')
                die('usage: $cli->RemoveAccountAlert($account, $timestamp)'."\n");
            $this->send('RemoveAccountAlert '.$account.' ALERT '.$timestamp);
            $this->_parseResponse();
        }
        
        function GetServerAlerts() {
            $this->send('GetServerAlerts');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }       
                
        function SetServerAlerts($alerts) {
            if(!is_array($alerts))
                die('usage: $cli->SetServerAlerts(array $alerts)'."\n");
            $this->send('SetServerAlerts '.$this->printWords($alerts));
            $this->_parseResponse();
        }
        
        function PostServerAlert($alert) {
            if($alert == '')
                die('usage: $cli->PostServerAlert(string $alert)'."\n");
            $this->send('PostServerAlert '.$this->printWords($alerts));
            $this->_parseResponse();
        }
        
        function RemoveServerAlert($timestamp) {
            if($timestamp == '')
                die('usage: $cli->RemoveServerAlert($timestamp)'."\n");
            $this->send('RemoveServerAlert '.$timestamp);
            $this->_parseResponse();
        }
        
        function GetClusterAlerts() {
            $this->send('GetClusterAlerts');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }       
                
        function SetClusterAlerts($alerts) {
            if(!is_array($alerts))
                die('usage: $cli->SetClusterAlerts(array $alerts)'."\n");
            $this->send('SetClusterAlerts '.$this->printWords($alerts));
            $this->_parseResponse();
        }
        
        function PostClusterAlert($alert) {
            if($alert == '')
                die('usage: $cli->PostClusterAlert(string $alert)'."\n");
            $this->send('PostClusterAlert '.$this->printWords($alerts));
            $this->_parseResponse();
        }
        
        function RemoveClusterAlert($timestamp) {
            if($timestamp == '')
                die('usage: $cli->RemoveClusterAlert($timestamp)'."\n");
            $this->send('RemoveClusterAlert '.$timestamp);
            $this->_parseResponse();
        }

        //////////////////////////////////////////////////
        // Personal Web Site administration commands        

        function GetWebFile($accountName,$fileName) {
            if($accountName == '' || $fileName == '')
                die('usage: $cli->GetWebFile(string $accountName, string $fileName)'."\n");
            $this->send('GetWebFile '.$accountName.' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }

        function PutWebFile($accountName,$fileName,$data) {
            if($accountName == '' || $fileName == '' || $data == '')
                die('usage: $cli->PutWebFile(string $accountName, string $fileName, string $data)'."\n");
            $this->send('PutWebFile '.$accountName.' FILE '.$this->printWords($fileName).' DATA "'.$data.'"');
            $this->_parseResponse();
        }

        function RenameWebFile($accountName,$oldFileName,$newFileName) {
            if($accountName == '' || $oldFileName == '' || $newFileName == '')
                die('usage: $cli->RenameWebFile(string $accountName, string $oldFileName, string $newFileName)'."\n");
            $command = 'RenameWebFile '.$accountName;
            $command .= ' FILE '.$this->printWords($oldFileName);
            $command .= ' INTO '.$this->printWords($newFileName);
            $this->send($command);
            $this->_parseResponse();
        }

        function DeleteWebFile($accountName,$fileName) {
            if($accountName == '' || $fileName == '')
                die('usage: $cli->DeleteWebFile(string $accountName, string $fileName)'."\n");
            $this->send('DeleteWebFile '.$accountName.' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
        }

        function ListWebFiles($accountName,$filePath='') {
            if($accountName == '')
                die('usage: $cli->ListWebFiles(string $accountName[, string $filePath])'."\n");
            $command = 'ListWebFiles '.$accountName;
            if($filePath != '') {
                $command .= ' PATH '.$this->printWords($filePath);
            }
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }

        function GetWebFilesInfo($accountName) {
            if($accountName == '')
                die('usage: $cli->GetWebFilesInfo(string $accountName)'."\n");
            $this->send('GetWebFilesInfo '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }

        //////////////////////////////////////////////////
        // List management commands     

        function ListLists($domain='') {
            $command = 'LISTLISTS';
            if($domain != '') $command .= ' '.$domain;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetDomainLists($domain='') {
            $command = 'GetDomainLists';
            if($domain != '') $command .= ' '.$domain;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetAccountLists($accountName) {
            if($accountName == '')
                die('usage: $cli->GetAccountLists(string $accountName)'."\n");
            $this->send('GetAccountLists '.$accountName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function CreateList($listName, $accountName) {
            if($listName == '' || $accountName == '')
                die('usage: $cli->CreateList(string $listName, string $accountName)'."\n");
            $this->send('CREATELIST '.$this->printWords($listName).' for '.$accountName);
            $this->_parseResponse();
        }
        
        function RenameList($oldListName, $newListName) {
            if($oldListName == '' || $newListName == '')
                die('usage: $cli->RenameList(string $oldListName, string $newListName)'."\n");
            $this->send('RENAMELIST '.$oldListName.' into '.$newListName);
            $this->_parseResponse();
        }
        
        function DeleteList($listName) {
            if($listName == '')
                die('usage: $cli->DeleteList(string $listName)'."\n");
            $this->send('DELETELIST '.$listName);
            $this->_parseResponse();
        }

        function GetList($listName) {
            if($listName == '')
                die('usage: $cli->GetList(string $listName)'."\n");
            $this->send('GETLIST '.$listName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function UpdateList($listName, $params) {
            if($listName == '' || !is_array($params))
                die('usage: $cli->UpdateList(string $listName, array $params)'."\n");
            $this->send('UPDATELIST '.$listName.' '.$this->printWords($params));
            $this->_parseResponse();
        }
        
        // replacement for the CLI.pm 'List' command, since there's a PHP internal 
        // function called 'List'
        function ListCommand($listName, $command, $subscriber, $options = '') {
            if($listName == '' || $command == '' || $subscriber == '' || !is_array($options))
                die('usage: $cli->ListCommand(string $listName, string $command, string $subscriber, array $options)'."\n");
            $this->send('LIST '.$listName.' '.$command.' '.join(' ',$options).' '.$subscriber);
            $this->_parseResponse();
        }
        
        function ListSubscribers($listName,$filter='',$limit=0) {
            if($listName == '')
                die('usage: $cli->ListSubscribers(string $listName[, string $filter[, int $limit]])'."\n");
            $command = 'ListSubscribers '.$listName;
            if($filter != '')
                $command .= ' FILTER '.$this->printWords($filter);
            if($limit > 0)
                $command .= " $limit";
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetSubscriberInfo($listName,$address) {
            if($listName == '' || $address == '')
                die('usage: $cli->GetSubscriberInfo(string $listName, string $address)'."\n");
            $this->send('GetSubscriberInfo '.$listName.' NAME '.$address);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetPostingMode($listName, $address, $mode) {
            if($listName == '' || $address == '' || $mode == '')
                die('usage: $cli->SetPostingMode(string $listName, string $address, string $mode)'."\n");
            $this->send('SetPostingMode '.$listName.' FOR '.$address.' '.$mode);
            $this->_parseResponse();
        }

        
        //////////////////////////////////////////////////
        // Web Skins administration commands        
    
        // Domain Skins
        function ListDomainSkins($domainName) {
            if($domainName == '')
                die('usage: $cli->ListDomainSkins(string $domainName)'."\n");
            $this->send('ListDomainSkins '.$domainName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function CreateDomainSkin($domainName,$skinName) {
            if($domainName == '')
                die('usage: $cli->CreateDomainSkin(string $domainName, string $skinName)'."\n");
            $this->send('CreateDomainSkin '.$domainName.' SKIN '.$this->printWords($skinName));
            $this->_parseResponse();
        }
        
        function RenameDomainSkin($domainName, $oldSkinName, $newSkinName) {
            if($domainName == '' || $oldSkinName == '' || $newSkinName == '')
                die('usage: $cli->RenameDomainSkin(string $domainName, string $oldSkinName, string $newSkinName)'."\n");
            $this->send('RenameDomainSkin '.$domainName.' SKIN '.$this->printWords($oldSkinName).' into '.$this->printWords($newSkinName));
            $this->_parseResponse();
        }
        
        function DeleteDomainSkin($domainName,$skinName) {
            if($domainName == '' || $skinName == '')
                die('usage: $cli->DeleteDomainSkin(string $domainName, string $skinName)'."\n");
            $this->send('DeleteDomainSkin '.$domainName.' SKIN '.$this->printWords($skinName));
            $this->_parseResponse();
        }
        
        function ListDomainSkinFiles($domainName,$skinName) {
            if($domainName == '' || $skinName == '')
                die('usage: $cli->ListDomainSkinFiles(string $domainName, string $skinName)'."\n");
            $this->send('ListDomainSkinFiles '.$domainName.' SKIN '.$this->printWords($skinName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function ReadDomainSkinFile($domainName,$skinName,$fileName) {
            if($domainName == '' || $skinName == '' || $fileName == '')
                die('usage: $cli->ReadDomainSkinFile(string $domainName, string $skinName, string $fileName)'."\n");
            $this->send('ReadDomainSkinFile '.$domainName.' SKIN '.$this->printWords($skinName).' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function StoreDomainSkinFile($domainName,$skinName,$fileName,$data) {
            if($domainName == '' || $skinName == '' || $fileName == '' || $data == '')
                die('usage: $cli->StoreDomainSkinFile(string $domainName, string $skinName, string $fileName, string $base64data)'."\n");
            $this->send('StoreDomainSkinFile '.$domainName.' SKIN '.$this->printWords($skinName).' FILE '.$this->printWords($fileName).' DATA "'.$data.'"');
            $this->_parseResponse();
        }
        
        function DeleteDomainSkinFile($domainName,$skinName,$fileName) {
            if($domainName == '' || $skinName == '' || $fileName == '')
                die('usage: $cli->DeleteDomainSkinFile(string $domainName, string $skinName, string $fileName)'."\n");
            $this->send('DeleteDomainSkinFile '.$domainName.' SKIN '.$this->printWords($skinName).' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
        }
        
        // Server Skins
        function ListServerSkins() {
            $this->send('ListServerSkins');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function CreateServerSkin($skinName) {
            if($skinName == '')
                die('usage: $cli->CreateServerSkin(string $skinName)'."\n");
            $this->send('CreateServerSkin '.$this->printWords($skinName));
            $this->_parseResponse();
        }
        
        function RenameServerSkin($oldSkinName, $newSkinName) {
            if($oldSkinName == '' || $newSkinName == '')
                die('usage: $cli->RenameServerSkin(string $oldSkinName, string $newSkinName)'."\n");
            $this->send('RenameServerSkin '.$this->printWords($oldSkinName).' into '.$this->printWords($newSkinName));
            $this->_parseResponse();
        }
        
        function DeleteServerSkin($skinName) {
            if($skinName == '')
                die('usage: $cli->DeleteServerSkin(string $skinName)'."\n");
            $this->send('DeleteServerSkin '.$this->printWords($skinName));
            $this->_parseResponse();
        }
        
        function ListServerSkinFiles($skinName) {
            if($skinName == '')
                die('usage: $cli->ListServerSkinFiles(string $skinName)'."\n");
            $this->send('ListServerSkinFiles '.$this->printWords($skinName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function ReadServerSkinFile($skinName,$fileName) {
            if($skinName == '' || $fileName == '')
                die('usage: $cli->ReadServerSkinFile(string $skinName, string $fileName)'."\n");
            $this->send('ReadServerSkinFile '.$this->printWords($skinName).' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function StoreServerSkinFile($skinName,$fileName,$data) {
            if($skinName == '' || $fileName == '' || $data == '')
                die('usage: $cli->StoreServerSkinFile(string $skinName, string $fileName, string $base64data)'."\n");
            $this->send('StoreServerSkinFile '.$this->printWords($skinName).' FILE '.$this->printWords($fileName).' DATA "'.$data.'"');
            $this->_parseResponse();
        }
        
        function DeleteServerSkinFile($skinName,$fileName) {
            if($skinName == '' || $fileName == '')
                die('usage: $cli->DeleteServerSkinFile(string $skinName, string $fileName)'."\n");
            $this->send('DeleteServerSkinFile '.$this->printWords($skinName).' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
        }
        
        // Cluster Skins
        function ListClusterSkins() {
            $this->send('ListClusterSkins');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function CreateClusterSkin($skinName) {
            if($skinName == '')
                die('usage: $cli->CreateClusterSkin(string $skinName)'."\n");
            $this->send('CreateClusterSkin '.$this->printWords($skinName));
            $this->_parseResponse();
        }
        
        function RenameClusterSkin($oldSkinName, $newSkinName) {
            if($oldSkinName == '' || $newSkinName == '')
                die('usage: $cli->RenameClusterSkin(string $oldSkinName, string $newSkinName)'."\n");
            $this->send('RenameClusterSkin '.$this->printWords($oldSkinName).' into '.$this->printWords($newSkinName));
            $this->_parseResponse();
        }
        
        function DeleteClusterSkin($skinName) {
            if($skinName == '')
                die('usage: $cli->DeleteClusterSkin(string $skinName)'."\n");
            $this->send('DeleteClusterSkin '.$this->printWords($skinName));
            $this->_parseResponse();
        }
        
        function ListClusterSkinFiles($skinName) {
            if($skinName == '')
                die('usage: $cli->ListClusterSkinFiles(string $skinName)'."\n");
            $this->send('ListClusterSkinFiles '.$this->printWords($skinName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function ReadClusterSkinFile($skinName,$fileName) {
            if($skinName == '' || $fileName == '')
                die('usage: $cli->ReadClusterSkinFile(string $skinName, string $fileName)'."\n");
            $this->send('ReadClusterSkinFile '.$this->printWords($skinName).' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function StoreClusterSkinFile($skinName,$fileName,$data) {
            if($skinName == '' || $fileName == '' || $data == '')
                die('usage: $cli->StoreClusterSkinFile(string $skinName, string $fileName, string $base64data)'."\n");
            $this->send('StoreClusterSkinFile '.$this->printWords($skinName).' FILE '.$this->printWords($fileName).' DATA "'.$data.'"');
            $this->_parseResponse();
        }
        
        function DeleteClusterSkinFile($skinName,$fileName) {
            if($skinName == '' || $fileName == '')
                die('usage: $cli->DeleteClusterSkinFile(string $skinName, string $fileName)'."\n");
            $this->send('DeleteClusterSkinFile '.$this->printWords($skinName).' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
        }
        
        //////////////////////////////////////////////////
        // Web Interface tuning commands        
    
        function ListWebUserInterface($domainName='',$path='') {
            $command = 'ListWebUserInterface';
            if($domainName != '') $command .= ' '.$domainName;
            if($path != '') $command .= ' PATH '.$this->printWords($path);
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
            
        function GetWebUserInterface($domainName,$fileName) {
            if($domainName == '' || $fileName == '')
                die('usage: $cli->GetWebUserInterface(string $domainName, string $fileName)'."\n");
            $this->send('GetWebUserInterface '.$domainName.' FILE '.$this->printWords($fileName));
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function PutWebUserInterface($domainName,$fileName,$data) {
            if($domainName == '' || $fileName == '' || $data == '')
                die('usage: $cli->PutWebUserInterface(string $domainName, string $fileName, string $base64data)'."\n");
            $this->send('PutWebUserInterface '.$domainName.' FILE '.$this->printWords($fileName).' DATA "'.$data.'"');
            $this->_parseResponse();
        }
        
        function DeleteWebUserInterface($domainName,$path) {
            if($domainName == '' || $path == '')
                die('usage: $cli->DeleteWebUserInterface(string $domainName, string $path)'."\n");
            $this->send('DeleteWebUserInterface '.$domainName.' FILE '.$this->printWords($path));
            $this->_parseResponse();
        }
        
        function ClearWebUserCache($domainName='') {
            $command = 'ClearWebUserCache';
            if($domainName != '')
                $command .= ' '.$domainName;
            $this->send($command);
            $this->_parseResponse();
        }
        
        //////////////////////////////////////////////////
        // Web Interface integration commands       
    
        function CreateWebUserSession($accountName,$ipAddress) {
            if($accountName == '' || $ipAddress == '')
                die('usage: $cli->CreateWebUserSession(string $accountName, string $ipAddress)'."\n");
            $this->send('CreateWebUserSession '.$accountName.' ADDRESS '.$ipAddress);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetWebUserSession($sessionID) {
            if($sessionID == '')
                die('usage: $cli->GetWebUserSession(string $sessionID)'."\n");
            $this->send('GetWebUserSession '.$sessionID);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function KillWebUserSession($sessionID) {
            if($sessionID == '')
                die('usage: $cli->KillWebUserSession(string $sessionID)'."\n");
            $this->send('KillWebUserSession '.$sessionID);
            $this->_parseResponse();
        }

        //////////////////////////////////////////////////
        // Server Settings commands     

        function GetModule($moduleName) {
            if($moduleName == '')
                die('usage: $cli->GetModule(string $moduleName)'."\n");
            $this->send('GETMODULE '.$moduleName);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function UpdateModule($moduleName, $newSettings) {
            if($moduleName == '' || !is_array($newSettings))
                die('usage: $cli->UpdateModule(string $moduleName, array $newSettings)'."\n");
            $this->send('UPDATEMODULE '.$moduleName.' '.$this->printWords($newSettings));
            $this->_parseResponse();
        }
        
        function SetModule($moduleName, $settings) {
            if($moduleName == '' || !is_array($settings))
                die('usage: $cli->SetModule(string $moduleName, array $settings)'."\n");
            $this->send('SetModule '.$moduleName.' '.$this->printWords($settings));
            $this->_parseResponse();
        }
        
        function GetBlacklistedIPs() {
            $this->send('GetBlacklistedIPs');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetClientIPs() {
            $this->send('GetClientIPs');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetWhiteHoleIPs() {
            $this->send('GetWhiteHoleIPs');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetProtection() {
            $this->send('GetProtection');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetBanned() {
            $this->send('GetBanned');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
    
        function SetBlacklistedIPs($addresses) {
            if($addresses == '')
                die('usage: $cli->SetBlacklistedIPs("11.22.33.44\\\e55.66.77.88")'."\n");
            $this->send('SetBlacklistedIPs '.$this->printWords($addresses));
            $this->_parseResponse();
        }
        
        function SetClientIPs($addresses) {
            if($addresses == '')
                die('usage: $cli->SetClientIPs("11.22.33.44\\\e55.66.77.88")'."\n");
            $this->send('SetClientIPs '.$this->printWords($addresses));
            $this->_parseResponse();
        }
        
        function SetWhiteHoleIPs($addresses) {
            if($addresses == '')
                die('usage: $cli->SetWhiteHoleIPs("11.22.33.44\\\e55.66.77.88")'."\n");
            $this->send('SetWhiteHoleIPs '.$this->printWords($addresses));
            $this->_parseResponse();
        }   
        
        function SetProtection($settings) {
            if(!is_array($settings))
                die('usage: $cli->SetProtection(array $settings)'."\n");
            $this->send('SetProtection '.$this->printWords($settings));
            $this->_parseResponse();
        }

        function SetBanned($settings) {
            if(!is_array($settings))
                die('usage: $cli->SetBanned(array $settings)'."\n");
            $this->send('SetBanned '.$this->printWords($settings));
            $this->_parseResponse();
        }

        function GetClusterBlacklistedIPs() {
            $this->send('GetClusterBlacklistedIPs');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetClusterClientIPs() {
            $this->send('GetClusterClientIPs');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function GetClusterWhiteHoleIPs() {
            $this->send('GetClusterWhiteHoleIPs');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetClusterProtection() {
            $this->send('GetClusterProtection');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }
        
        function GetClusterBanned() {
            $this->send('GetClusterBanned');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }
        }

        function SetClusterBlacklistedIPs($addresses) {
            if($addresses == '')
                die('usage: $cli->SetClusterBlacklistedIPs("11.22.33.44\\\e55.66.77.88")'."\n");
            $this->send('SetClusterBlacklistedIPs '.$this->printWords($addresses));
            $this->_parseResponse();
        }
        
        function SetClusterClientIPs($addresses) {
            if($addresses == '')
                die('usage: $cli->SetClusterClientIPs("11.22.33.44\\\e55.66.77.88")'."\n");
            $this->send('SetClusterClientIPs '.$this->printWords($addresses));
            $this->_parseResponse();
        }
        
        function SetClusterWhiteHoleIPs($addresses) {
            if($addresses == '')
                die('usage: $cli->SetClusterWhiteHoleIPs("11.22.33.44\\\e55.66.77.88")'."\n");
            $this->send('SetClusterWhiteHoleIPs '.$this->printWords($addresses));
            $this->_parseResponse();
        }   
        
        function SetClusterProtection($settings) {
            if(!is_array($settings))
                die('usage: $cli->SetClusterProtection(array $settings)'."\n");
            $this->send('SetClusterProtection '.$this->printWords($settings));
            $this->_parseResponse();
        }

        function SetClusterBanned($settings) {
            if(!is_array($settings))
                die('usage: $cli->SetClusterBanned(array $settings)'."\n");
            $this->send('SetClusterBanned '.$this->printWords($settings));
            $this->_parseResponse();
        }

        function GetServerRules() {
            $this->send('GetServerRules');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }
        
        function SetServerRules($rules) {
            if(!is_array($rules))
                die('usage: $cli->SetServerRules(array $rules)'."\n");
            $this->send('SetServerRules '.$this->printWords($rules));
            $this->_parseResponse();
        }

        function GetClusterRules() {
            $this->send('GetClusterRules');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }
        
        function SetClusterRules($rules) {
            if(!is_array($rules))
                die('usage: $cli->SetClusterRules(array $rules)'."\n");
            $this->send('SetClusterRules '.$this->printWords($rules));
            $this->_parseResponse();
        }

        function RefreshOSData() {
            $this->send('RefreshOSData');
            $this->_parseResponse();
        }
        
        function GetRouterTable() {
            $this->send('GetRouterTable');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }
        
        function SetRouterTable($table) {
            if($table == '') {
                $err = 'usage:'."\n";
                $err .= '   $table = "<addr1>=addr1@domain.com\\e<addr2>=addr2@domain.com\\e";'."\n";
                $err .= '   $cli->SetRouterTable($table)'."\n";
                die("$err");
            } else {
                $this->send('SetRouterTable '.$this->printWords($table));
                $this->_parseResponse();
            }
        }
        
        function GetClusterRouterTable() {
            $this->send('GetClusterRouterTable');
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }
        
        function SetClusterRouterTable($table) {
            if($table == '') {
                $err = 'usage:'."\n";
                $err .= '   $table = "<addr1>=addr1@domain.com\\e<addr2>=addr2@domain.com\\e";'."\n";
                $err .= '   $cli->SetClusterRouterTable($table)'."\n";
                die("$err");
            } else {
                $this->send('SetClusterRouterTable '.$this->printWords($table));
                $this->_parseResponse();
            }
        }
        
        function Route($address) {
            if($address == '')
                die('usage: $cli->Route(string $address)'."\n");
            $this->send('Route '.$address);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }
        
        //////////////////////////////////////////////////
        // Monitoring commands      

        function GetSNMPElement($element) {
            $this->send('GetSNMPElement '.$element);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }

        function ServerShutdown() {
            $this->send('SHUTDOWN');
            $this->_parseResponse();
        }


        //////////////////////////////////////////////////
        // Statistics commands      
        
        function GetAccountStat($accountName, $key='') {
            if($accountName == '')
                die('usage: $cli->GetAccountStat(string $accountName[, string $key])'."\n");
            $command = 'GetAccountStat '.$accountName;
            if($key != '') $command .= ' Key '.$key;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }

        function ResetAccountStat($accountName, $key='') {
            if($accountName == '')
                die('usage: $cli->ResetAccountStat(string $accountName[, string $key])'."\n");
            $command = 'ResetAccountStat '.$accountName;
            if($key != '') $command .= ' Key '.$key;
            $this->send($command);
            $this->_parseResponse();
        }

        function GetDomainStat($domainName, $key='') {
            if($domainName == '')
                die('usage: $cli->GetDomainStat(string $domainName[, string $key])'."\n");
            $command = 'GetDomainStat '.$domainName;
            if($key != '') $command .= ' Key '.$key;
            $this->send($command);
            $this->_parseResponse();
            if($this->isSuccess()) {
                return $this->parseWords($this->getWords());
            }           
        }

        function ResetDomainStat($domainName, $key='') {
            if($domainName == '')
                die('usage: $cli->ResetDomainStat(string $domainName[, string $key])'."\n");
            $command = 'ResetDomainStat '.$domainName;
            if($key != '') $command .= ' Key '.$key;
            $this->send($command);
            $this->_parseResponse();
        }

        //////////////////////////////////////////////////
        // Miscellaneous commands       
        
        function WriteLog($level, $msg) {
            if($level == '' || $msg == '')
                die('usage: $cli->WriteLog(int $level, string $msg)'."\n");
            $this->send('WriteLog '.$level.' '.$this->printWords($msg));
            $this->_parseResponse();
        }

        function ReleaseSMTPQueue($queue) {
            if($queue == '')
                die('usage: $cli->ReleaseSMTPQueue(string $queueName)'."\n");
            $this->send('ReleaseSMTPQueue '.$queue);
            $this->_parseResponse();
        }

        //////////////////////////////////////////////////
        // Internal routines
        
        // sub _setStrangeError
        function _setStrangeError($line,$code) {
            if($code != '') {
                $this->errCode = $code;
            } else {
                // compatible with CLI_CODE_STRANGE from CLI.pm
                $this->errCode = 10000;
            }
            $this->errMsg = rtrim($line);
            return false;
        }
    
        // sub _parseResponse
        function _parseResponse() {
            $line = fgets($this->sp, (1024*10));
            if($this->debug) 
                echo "$line\n";
            if(preg_match("/^(\d+)\s(.*)$/",$line,$matches)) {
                $this->errCode = $matches[1];
                if($matches[1] == 201) {
                    // inline response
                    $this->inlineResponse = $matches[2];
                    $this->errMsg = "OK";
                } else {
                    // error
                    $this->errMsg = rtrim($matches[2]);
                }
                $this->isSuccess();
            } else {
                $this->_setStrangeError($line,$code);
            }
        }
        
        // sub convertOutput
        // prepares the $data for sending via fputs
        function convertOutput($data,$translate) {
            if(!isset($data)) {
                return ('');
            } elseif (is_array($data)) {
                // workaround:
                // Given that PHP arrays are all essentially associative,
                // we'll treat arrays with key values that look like numbers
                // as Perl-like arrays, and arrays with key values
                // that have alpha-characters in the keys as Perl-like "hashes"
                
                $firstKey = key($data);
                if(preg_match("/\D/",$firstKey)) {
                    $aType = "assoc";
                } else {
                    $aType = "num";
                }
                
                if($aType == "assoc") {
                    $outp='{';
                    for(reset($data); $key = key($data); next($data)) {
                        $outp .= $this->convertOutput($key,$this->translateStrings). '=' .$this->convertOutput($data["$key"],$this->translateStrings).';';
                    }
                    $outp.='}';
                } else {
                    $outp='(';
                    $first=1;
                    for($i=0; $i < count($data); $i++) {
                        if(!$first) { $outp .= ','; } else { $first=0; }
                        $outp .= $this->convertOutput($data[$i],$this->translateStrings);
                    }
                    $outp.=')';
                }
                return $outp;
            } else {
                if(preg_match("/[\W_]/",$data,$matches) || $data == '') {
                    if($translate) {
                        $data = preg_replace("/\\((?![enr\d]))/","\\\\"."$matches[1]",$data);
                        $data = str_replace('\"','\\\"',$data);
                    }

                    $data = preg_replace("/([\\x00-\\x1F\\x7F])/e",
                                "'\\' . 
                                str_repeat('0',( 3 - strlen(ord('\\1')) ) ) . 
                                ord('\\1')",
                                $data);

                    return '"'.$data.'"';
                } else {
                    return $data;
                }
            }
        }
        
        // sub printWords
        function printWords($data) {
            return $this->convertOutput($data,$this->translateStrings);
        }
        
        // sub strip - not needed thanks to PHP's "trim()"
        
        // sub getWords
        //
        //
        //  THIS IS NOT YET A COMPLETE TRANSLATION
        //  ... but it seems to work as-is anyway.
        //
        function getWords() {
            // if the inline response CODE was ok, return inlineResponse
            if($this->errCode == 201) {
                return $this->inlineResponse;
            }
            // if the inline response CODE was NOT ok, parse the errMsg
            //$bag = '';    $line = '';
            //$firstLine = true;
            //$lastLine = '';
            
            // this oughta work
            $line = $this->errMsg;
            $line = trim($line);
            return $line;
            
        }
                
        // sub send
        function send($command) {
            $this->currentCGateCommand = $command;
            if($this->debug)
                echo "SENT: fputs($"."this->sp,\"$command\")\n";
            fputs($this->sp,"$command\n");
        }
        
        // sub skipSpaces
        function skipSpaces() {
            while( $this->span < $this->len && preg_match("/\s/",substr($this->data,$this->span,1))) {
                ++$this->span;
            }
        }
        
        // sub readWord
        function readWord() {
            $isQuoted = 0;
            $isBlock = 0;
            $result = '';
            $this->skipSpaces();
            if(substr($this->data,$this->span,1) == '"') {
                $isQuoted = 1;
                ++$this->span;
            } elseif (substr($this->data,$this->span,1) == '[') {
                $isBlock = 1;
            }
            while($this->span < $this->len) {
                $ch = substr($this->data,$this->span,1);
                if ($isQuoted) {
                    if($ch == '\\') {
                        if(preg_match("/^(?:\"|\\|\d\d\d)/",substr($this->data,$this->span+1,3))) {
                            $ch = substr($this->data,++$this->span,3);
                            if(preg_match("/\d\d\d/",$ch)) {
                                $this->span+=2;
                                $ch=chr($ch);
                            } else {
                                $ch = substr($ch,0,1);
                                if(!$this->translateStrings) {
                                    $ch='\\'.$ch;
                                }
                            }
                        }
                    } elseif($ch == '"') {
                        ++$this->span;
                        break;
                    }
                } elseif ($isBlock) {
                    if ($ch == ']') {
                        $result .= $ch;
                        ++$this->span;
                        break;
                    }
                } elseif (preg_match("/[-a-zA-Z0-9\x80-\xff_\.\@\!\#\%]/",$ch)) {
                    // do nothing
                } else {
                    break;
                }
                $result .= $ch;
                ++$this->span;
            }
            return $result;
        }
        
        // sub readKey
        function readKey() {
            return $this->readWord();
        }
        
        // sub readValue
        function readValue() {
            $this->skipSpaces();
            $ch = substr($this->data,$this->span,1);
            if($ch == '{') {
                ++$this->span;
                return $this->readDictionary();
            } elseif ($ch == '(') {
                ++$this->span;
                return $this->readArray();
            } else {
                return $this->readWord();
            }
        }
        
        // sub readArray
        function readArray() {
            $result = array();
            while($this->span < $this->len) {
                $this->skipSpaces();
                if(substr($this->data,$this->span,1) == ')') {
                    ++$this->span;
                    break;
                } else {
                    $theValue = $this->readValue();
                    $this->skipSpaces();
                    array_push($result,$theValue);
                    if(substr($this->data,$this->span,1) == ',') {
                        // comma break
                        ++$this->span;
                    } elseif (substr($this->data,$this->span,1) == ')') {
                    } else {
                        die("CGPro output format error: '".substr($this->data,$this->span,1)."' (ASCII ".ord(substr($this->data,$this->span,1)).") encountered. ')' or ',' expected.\n");
                    }
                }
            }           
            return($result);
        }
        
        // sub readDictionary
        function readDictionary() {
            $result = array();
            while($this->span < $this->len) {
                $this->skipSpaces();
                if(substr($this->data,$this->span,1) == '}') {
                    ++$this->span;
                    break;
                } else {
                    $theKey = $this->readKey();
                    $this->skipSpaces();
                    if(substr($this->data,$this->span,1) != '=') die("CGPro output format error at '=':".substr($this->data,$this->span,10)."\n");
                    ++$this->span;
                    $result["$theKey"] = $this->readValue();
                    $this->skipSpaces();
                    if(substr($this->data,$this->span,1) != ';') die("CGPro output format error while reading value:".substr($this->data,$this->span,10)."\n");
                    ++$this->span;
                }
            }
            return($result);
        }
        
        // sub parseWords
        function parseWords($data) {
            $this->data = $data;
            $this->span = 0;
            $this->len = strlen($data);
            return $this->readValue();
        }
        
    
    } // end CLI class

}
?>