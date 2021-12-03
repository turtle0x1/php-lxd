# Changelog

All Notable changes to `php-lxd` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

# [0.21.0]

## Added
  - Recursion parameter for getting snapshots
  - Recursion parameter for getting networks

## Fixed
  - Cant create storage pool when sending empty config

# [0.20.0]
## Added
 - Create storage pool volume
 - Delete storage pool volume

# [0.19.1]

## Added
  - Optional target project parameter to copy instance

# [0.19.0]

## Added
 - Support for the warnings API

# [0.18.2]

## Change
 - Support recursion param on get all pools

# [0.18.1]

## Added
 - Get volume info

# [0.18.0]

## Added
 - Recursion parameter for getting images (#17)

## Changed
  - Make networks project aware (#16)


# [0.17.0]

## Added
  - Instance files are now project aware
  -  Add the timeout parameter correctly when waiting for an operation (@dhzavann)

## Changed
  - Delay check if vms are supported until needed (@TonyBogdanov)

# [0.16.4]

## Added
  - Recursion parameter for getting profiles

# [0.16.3]

## Added
  - Recursion parameter for getting cluster members

# [0.16.2]

## Fixed
  - Cant load project info because path is wrong

# [0.16.1]

## Added
  - Support passing alias param when creating image
  - Use "instance" instead of "container" when creating image from "container"

# [0.16.0]

## Added
  - Recursion parameter to get all instances / containers / vms

# [0.15.2]

## Added
 - Added optional target parameter for creating instance

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
