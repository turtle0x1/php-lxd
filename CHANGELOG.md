# Changelog

All Notable changes to `php-lxd` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

# [0.15.1]

## Fixed
 - Files method using the wrong param for headers

# [0.15.0]

## Added
 - Added an instance class that you should use instead of containers, it will
   fall back to the `/containers` endpoint if your host doesn't support `/instances`
   which is the agnostic way of dealing with both containers and virtual machines


# [0.14.0]

## Added
  - Provide backup as source type & file to create container from backup file

## [0.13.2]

## Fixed
 - not being able to cache responses due to bad namespaces


## [0.13.1]

## Added
 - Delete container file (#11 @TonyBogdanov)

## [0.13.0]

## Added
 - Some of the cluster endpoints

## [0.12.3]

## Fixed
 - Migrating snapshot of runnin container (#9)

## [0.12.2]

## Added
 - Support for using container snapshot as source for migration

## [0.12.1]

### Added
    - Backup export method

## [0.12.0]

### Added
 - Backup endpoints

## [0.6.0] - 2017-01-23

### Added
- Documentation
- container migration

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing
